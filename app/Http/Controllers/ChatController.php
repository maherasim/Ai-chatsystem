<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\User;
use App\Models\Group;
use App\Models\Team;
use App\Services\AgoraService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ChatController extends Controller
{
    protected $agoraService;

    public function __construct(AgoraService $agoraService)
    {
        $this->agoraService = $agoraService;
    }

    /**
     * Get chat view
     */
    public function index()
    {
        
        $headers = \App\Models\Setting::all();
        $setting = \App\Models\Setting::first();
        $groups = Group::all();
      //  dd($groups);
        $user = Auth::user();
        
        // Get conversations list
        $conversations = $this->getConversations($user->_id);
        
        // Get all groups without any conditions
        try {
            $allGroups = Group::all();
            \Log::info('Groups query executed', [
                'count' => $allGroups->count(),
                'connection' => 'mongodb',
                'collection' => 'groups'
            ]);
            
            if ($allGroups->count() > 0) {
                \Log::info('Groups found', [
                    'first_group_id' => (string)$allGroups->first()->_id,
                    'first_group_name' => $allGroups->first()->name
                ]);
            } else {
                \Log::warning('No groups found in database');
            }
        } catch (\Exception $e) {
            \Log::error('Error fetching groups', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            $allGroups = collect([]);
        }
        
        $groups = $allGroups->map(function($group) {
            // Load team separately
            $team = null;
            if ($group->team_id) {
                try {
                    $team = \App\Models\Team::find($group->team_id);
                } catch (\Exception $e) {
                    // Team not found
                }
            }
            
            // Handle member_ids - could be array or JSON string
            $memberIds = $group->member_ids ?? [];
            if (is_string($memberIds)) {
                $decoded = json_decode($memberIds, true);
                $memberIds = is_array($decoded) ? $decoded : [];
            }
            $memberCount = count($memberIds) + 1; // +1 for admin
            
            return [
                'id' => (string) $group->_id,
                'name' => $group->name ?? 'Untitled Group',
                'team_id' => $group->team_id,
                'team_photo' => $team && $team->thumb_path 
                    ? asset('storage/' . ltrim($team->thumb_path, '/'))
                    : asset('build/img/profile.svg'),
                'team_banner' => $team && $team->banner_path 
                    ? asset('storage/' . ltrim($team->banner_path, '/'))
                    : asset('build/img/bgractangle.svg'),
                'member_count' => $memberCount,
            ];
        })
        ->values();
        
        \Log::info('Final groups prepared for view', [
            'count' => $groups->count(),
            'groups' => $groups->toArray()
        ]);
        
        return view('Chats.chat', compact('headers', 'setting', 'conversations', 'groups'));
    }

    /**
     * Get Agora token for current user
     */
    public function getToken(Request $request)
    {
        $user = Auth::user();
        $userId = (string)$user->_id;

        try {
            // Create or get Agora user
            $avatarUrl = $this->getAvatarUrl($user);
            $this->agoraService->createUser($userId, $user->name ?? $user->email, $avatarUrl);

            // Generate chat token
            $tokenResponse = $this->agoraService->generateChatToken($userId);

            return response()->json([
                'success' => true,
                'app_id' => config('agora.app_id'),
                'user_id' => $userId,
                'token' => $tokenResponse['token'] ?? $tokenResponse['accessToken'] ?? null,
                'username' => $user->name ?? $user->email,
                'avatar' => $avatarUrl,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get conversations list API endpoint
     */
    public function getConversationsApi()
    {
        $conversations = $this->getConversations();
        return response()->json($conversations);
    }

    /**
     * Get conversations list
     */
    public function getConversations($userId = null)
    {
        $userId = $userId ?? Auth::id();
        $userId = (string)$userId;

        // Get all unique conversations for this user
        $conversations = ChatMessage::where(function ($query) use ($userId) {
            $query->where('from_user_id', $userId)
                ->orWhere('to_user_id', $userId);
        })
        ->where('is_deleted', false)
        ->get()
        ->groupBy('conversation_id')
        ->map(function ($messages) use ($userId) {
            $lastMessage = $messages->sortByDesc('created_at')->first();
            $otherUserId = $lastMessage->from_user_id === $userId 
                ? $lastMessage->to_user_id 
                : $lastMessage->from_user_id;
            
            $otherUser = User::find($otherUserId);
            
            return [
                'conversation_id' => $lastMessage->conversation_id,
                'other_user' => $otherUser ? [
                    'id' => (string)$otherUser->_id,
                    'name' => $otherUser->name ?? $otherUser->email,
                    'avatar' => $this->getAvatarUrl($otherUser),
                ] : null,
                'last_message' => [
                    'content' => $lastMessage->content,
                    'type' => $lastMessage->message_type,
                    'created_at' => $lastMessage->created_at->toIso8601String(),
                ],
                'unread_count' => ChatMessage::getUnreadCount($userId, $lastMessage->conversation_id),
            ];
        })
        ->values();

        return $conversations;
    }

    /**
     * Get messages for a conversation
     */
    public function getMessages(Request $request, $conversationId)
    {
        $user = Auth::user();
        $userId = (string)$user->_id;

        // Verify user is part of this conversation
        $message = ChatMessage::where('conversation_id', $conversationId)->first();
        if (!$message || 
            ($message->from_user_id !== $userId && $message->to_user_id !== $userId)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $limit = $request->input('limit', 50);
        $beforeMessageId = $request->input('before_message_id');

        $messages = ChatMessage::getConversationMessages($conversationId, $limit, $beforeMessageId);

        // Mark messages as read
        ChatMessage::markAsRead($conversationId, $userId);

        return response()->json([
            'success' => true,
            'messages' => $messages->map(function ($msg) {
                return $this->formatMessage($msg);
            }),
        ]);
    }

    /**
     * Get or create conversation with another user
     */
    public function getConversation(Request $request, $otherUserId)
    {
        $user = Auth::user();
        $userId = (string)$user->_id;
        $otherUserId = (string)$otherUserId;

        $conversationId = ChatMessage::generateConversationId($userId, $otherUserId);

        // Check if conversation exists
        $existingMessage = ChatMessage::where('conversation_id', $conversationId)->first();

        if (!$existingMessage) {
            // Create empty conversation (will be populated when first message is sent)
            return response()->json([
                'success' => true,
                'conversation_id' => $conversationId,
                'messages' => [],
            ]);
        }

        return $this->getMessages($request, $conversationId);
    }

    /**
     * Save message to database (called from frontend after Agora sends it)
     */
    public function saveMessage(Request $request)
    {
        $request->validate([
            'message_id' => 'required|string',
            'conversation_id' => 'required|string',
            'to_user_id' => 'required|string',
            'message_type' => 'required|string|in:txt,img,file,audio,video',
            'content' => 'required|string',
            'file_url' => 'nullable|string',
            'file_name' => 'nullable|string',
            'reply_to_message_id' => 'nullable|string',
        ]);

        $user = Auth::user();
        $userId = (string)$user->_id;

        $message = ChatMessage::create([
            'message_id' => $request->message_id,
            'from_user_id' => $userId,
            'to_user_id' => $request->to_user_id,
            'conversation_id' => $request->conversation_id,
            'message_type' => $request->message_type,
            'content' => $request->content,
            'file_url' => $request->file_url,
            'file_name' => $request->file_name,
            'file_size' => $request->file_size,
            'reply_to_message_id' => $request->reply_to_message_id,
            'is_read' => false,
            'reactions' => [],
        ]);

        return response()->json([
            'success' => true,
            'message' => $this->formatMessage($message),
        ]);
    }

    /**
     * Upload file for chat
     */
    public function uploadFile(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240', // 10MB max
            'type' => 'required|in:image,file,audio,video',
        ]);

        $file = $request->file('file');
        $type = $request->type;
        
        $fileName = Str::random(20) . '_' . time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('chat/' . $type, $fileName, 'public');

        return response()->json([
            'success' => true,
            'file_url' => asset('storage/' . $path),
            'file_name' => $file->getClientOriginalName(),
            'file_size' => $file->getSize(),
            'file_type' => $file->getMimeType(),
        ]);
    }

    /**
     * Mark messages as read
     */
    public function markAsRead(Request $request, $conversationId)
    {
        $user = Auth::user();
        $userId = (string)$user->_id;

        ChatMessage::markAsRead($conversationId, $userId);

        return response()->json(['success' => true]);
    }

    /**
     * Delete message
     */
    public function deleteMessage(Request $request, $messageId)
    {
        $user = Auth::user();
        $userId = (string)$user->_id;

        $message = ChatMessage::find($messageId);
        
        if (!$message || $message->from_user_id !== $userId) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $message->update(['is_deleted' => true]);

        return response()->json(['success' => true]);
    }

    /**
     * Add reaction to message
     */
    public function addReaction(Request $request, $messageId)
    {
        $request->validate([
            'emoji' => 'required|string',
        ]);

        $user = Auth::user();
        $userId = (string)$user->_id;

        $message = ChatMessage::find($messageId);
        if (!$message) {
            return response()->json(['error' => 'Message not found'], 404);
        }

        $reactions = $message->reactions ?? [];
        
        // Remove existing reaction from this user
        $reactions = array_filter($reactions, function ($r) use ($userId) {
            return ($r['user_id'] ?? null) !== $userId;
        });

        // Add new reaction
        $reactions[] = [
            'user_id' => $userId,
            'emoji' => $request->emoji,
            'created_at' => now()->toIso8601String(),
        ];

        $message->update(['reactions' => array_values($reactions)]);

        return response()->json([
            'success' => true,
            'reactions' => $message->fresh()->reactions,
        ]);
    }

    /**
     * Format message for API response
     */
    private function formatMessage($message)
    {
        // Check if message has group_id and user is in group's member_ids
        $groupName = null;
        if ($message->group_id) {
            $user = Auth::user();
            if ($user) {
                $messageGroup = Group::find($message->group_id);
                if ($messageGroup) {
                    $userId = (string)($user->_id ?? $user->id);
                    $memberIds = array_map('strval', $messageGroup->member_ids ?? []);
                    // Check if user is in member_ids or is admin
                    if (in_array($userId, $memberIds) || (string)$messageGroup->admin_id === $userId) {
                        $groupName = $messageGroup->name ?? null;
                    }
                }
            }
        }

        return [
            'id' => (string)$message->_id,
            'message_id' => $message->message_id,
            'from_user_id' => (string)$message->from_user_id,
            'to_user_id' => (string)$message->to_user_id,
            'conversation_id' => $message->conversation_id,
            'message_type' => $message->message_type,
            'content' => $message->content,
            'file_url' => $message->file_url,
            'file_name' => $message->file_name,
            'file_size' => $message->file_size,
            'reply_to_message_id' => $message->reply_to_message_id ? (string)$message->reply_to_message_id : null,
            'is_read' => $message->is_read,
            'read_at' => $message->read_at?->toIso8601String(),
            'reactions' => $message->reactions ?? [],
            'group_name' => $groupName, // Add group name if user is member
            'created_at' => $message->created_at->toIso8601String(),
            'sender' => $message->sender ? [
                'id' => (string)$message->sender->_id,
                'name' => $message->sender->name ?? $message->sender->email,
                'avatar' => $this->getAvatarUrl($message->sender),
            ] : null,
        ];
    }

    /**
     * Get group messages
     */
    public function getGroupMessages($groupId, Request $request)
    {
        try {
            $user = Auth::user();
            
            // Verify user is member of group
            $group = Group::find($groupId);
            if (!$group) {
                return response()->json([
                    'success' => false,
                    'message' => 'Group not found',
                ], 404);
            }

            // Get last_id from request for polling
            $lastId = $request->input('last_id');
            
            // Build query
            $query = ChatMessage::where(function($q) use ($groupId) {
                    $q->where('group_id', $groupId)
                      ->orWhere('conversation_id', 'group_' . $groupId);
                });

            // If last_id is provided, only get messages after that ID
            if ($lastId && strlen($lastId) === 24 && ctype_xdigit($lastId)) {
                try {
                    $query->where('_id', '>', new \MongoDB\BSON\ObjectId($lastId));
                } catch (\Exception $e) {
                    \Log::warning('Invalid last_id format for polling', ['last_id' => $lastId]);
                }
            }

            // Get messages for this group
            $messages = $query->orderBy('created_at', 'asc')
                ->limit(100)
                ->get();

            // Format messages
            $formattedMessages = $messages->map(function($message) use ($user) {
                $senderId = $message->sender_id ?? $message->from_user_id;
                $sender = $senderId ? User::find($senderId) : null;
                $repliedTo = null;
                
                $repliedToId = $message->replied_to_message_id ?? $message->reply_to_message_id;
                if ($repliedToId) {
                    $repliedMsg = ChatMessage::find($repliedToId);
                    if ($repliedMsg) {
                        $repliedSenderId = $repliedMsg->sender_id ?? $repliedMsg->from_user_id;
                        $repliedSender = $repliedSenderId ? User::find($repliedSenderId) : null;
                        $repliedTo = [
                            'id' => (string)$repliedMsg->_id,
                            'content' => $repliedMsg->content,
                            'sender_name' => $repliedSender ? ($repliedSender->name ?? $repliedSender->email) : 'Unknown',
                        ];
                    }
                }

                // Check if message has group_id and user is in group's member_ids
                $groupName = null;
                if ($message->group_id) {
                    $messageGroup = Group::find($message->group_id);
                    if ($messageGroup && $user) {
                        $userId = (string)($user->_id ?? $user->id);
                        $memberIds = array_map('strval', $messageGroup->member_ids ?? []);
                        // Check if user is in member_ids or is admin
                        if (in_array($userId, $memberIds) || (string)$messageGroup->admin_id === $userId) {
                            $groupName = $messageGroup->name ?? null;
                        }
                    }
                }

                return [
                    '_id' => (string)$message->_id,
                    'id' => (string)$message->_id,
                    'message_id' => $message->message_id, // Return Agora message ID
                    'sender_id' => (string)($senderId ?? ''),
                    'from_user_id' => (string)($senderId ?? ''), // Also include for compatibility
                    'sender_name' => $sender ? ($sender->name ?? $sender->email) : 'Unknown',
                    'sender_avatar' => $this->getAvatarUrl($sender),
                    'content' => $message->content,
                    'message_type' => $message->message_type ?? 'txt',
                    'file_url' => $message->file_url,
                    'file_name' => $message->file_name,
                    'file_size' => $message->file_size,
                    'reactions' => $message->reactions ?? [],
                    'replied_to_message' => $repliedTo,
                    'group_name' => $groupName, // Add group name if user is member
                    'created_at' => $message->created_at->toIso8601String(),
                ];
            });

            return response()->json([
                'success' => true,
                'messages' => $formattedMessages,
            ]);
        } catch (\Exception $e) {
            \Log::error('Failed to get group messages', [
                'error' => $e->getMessage(),
                'group_id' => $groupId,
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to load messages',
            ], 500);
        }
    }

    /**
     * Save group message
     */
    public function saveGroupMessage(Request $request)
    {
        try {
            $user = Auth::user();
            
            $request->validate([
                'group_id' => 'required|string',
                'content' => 'nullable|string',
                'message_type' => 'required|in:txt,img,file,audio,video',
                'file_url' => 'nullable|string',
                'file_name' => 'nullable|string',
                'file_size' => 'nullable|integer',
                'replied_to_message_id' => 'nullable|string',
                'message_id' => 'nullable|string',
            ]);

            // Verify user is member of group
            $group = Group::find($request->group_id);
            if (!$group) {
                return response()->json([
                    'success' => false,
                    'message' => 'Group not found',
                ], 404);
            }

            // Create message
            $message = new ChatMessage();
            $message->sender_id = $user->_id;
            $message->from_user_id = $user->_id; // Also set for compatibility
            $message->group_id = $request->group_id;
            $message->conversation_id = 'group_' . $request->group_id;
            $message->message_type = $request->message_type;
            $message->content = $request->content;
            $message->file_url = $request->file_url;
            $message->file_name = $request->file_name;
            $message->file_size = $request->file_size;
            $message->replied_to_message_id = $request->replied_to_message_id;
            $message->reply_to_message_id = $request->replied_to_message_id; // Also set for compatibility
            $message->message_id = $request->message_id; // Save Agora message ID
            $message->reactions = [];
            $message->save();

            return response()->json([
                'success' => true,
                'message' => $this->formatGroupMessage($message),
            ]);
        } catch (\Exception $e) {
            \Log::error('Failed to save group message', [
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to send message',
            ], 500);
        }
    }

    /**
     * Format group message for API response
     */
    private function formatGroupMessage($message)
    {
        $senderId = $message->sender_id ?? $message->from_user_id;
        $sender = $senderId ? User::find($senderId) : null;
        $repliedTo = null;
        
        $repliedToId = $message->replied_to_message_id ?? $message->reply_to_message_id;
        if ($repliedToId) {
            $repliedMsg = ChatMessage::find($repliedToId);
            if ($repliedMsg) {
                $repliedSenderId = $repliedMsg->sender_id ?? $repliedMsg->from_user_id;
                $repliedSender = $repliedSenderId ? User::find($repliedSenderId) : null;
                $repliedTo = [
                    'id' => (string)$repliedMsg->_id,
                    'content' => $repliedMsg->content,
                    'sender_name' => $repliedSender ? ($repliedSender->name ?? $repliedSender->email) : 'Unknown',
                ];
            }
        }

        return [
            '_id' => (string)$message->_id,
            'id' => (string)$message->_id,
            'message_id' => $message->message_id, // Return Agora message ID
            'sender_id' => (string)($senderId ?? ''),
            'sender_name' => $sender ? ($sender->name ?? $sender->email) : 'Unknown',
            'sender_avatar' => $this->getAvatarUrl($sender),
            'content' => $message->content,
            'message_type' => $message->message_type ?? 'txt',
            'file_url' => $message->file_url,
            'file_name' => $message->file_name,
            'file_size' => $message->file_size,
            'reactions' => $message->reactions ?? [],
            'replied_to_message' => $repliedTo,
        ];
    }

    /**
     * Get avatar URL checking both public and storage paths
     */
    private function getAvatarUrl($user)
    {
        if (!$user || !$user->image) {
            return null;
        }
        
        $image = ltrim($user->image, '/');
        
        // Check public/upload/...
        if (file_exists(public_path($image))) {
            return asset($image);
        }
        
        // Check storage/app/public/upload/...
        if (file_exists(storage_path('app/public/' . $image))) {
            return asset('storage/' . $image);
        }
        
        // Default to public path if file not found (legacy behavior)
        return asset($image);
    }

    /**
     * Get user's groups for notifications
     */
    public function getUserGroups()
    {
        try {
            $user = Auth::user();
            $userId = (string)$user->_id;

            // Get all groups
            $allGroups = Group::all();

            // Filter groups where user is admin or member
            $userGroups = $allGroups->filter(function($group) use ($userId) {
                // Check if user is admin
                if ((string)$group->admin_id === $userId) {
                    return true;
                }

                // Check if user is in member_ids
                $memberIds = $group->member_ids ?? [];
                if (is_string($memberIds)) {
                    $decoded = json_decode($memberIds, true);
                    $memberIds = is_array($decoded) ? $decoded : [];
                }

                if (is_array($memberIds)) {
                    foreach ($memberIds as $memberId) {
                        if ((string)$memberId === $userId) {
                            return true;
                        }
                    }
                }

                return false;
            });

            $formattedGroups = $userGroups->map(function($group) {
                return [
                    '_id' => (string)$group->_id,
                    'id' => (string)$group->_id,
                    'name' => $group->name ?? 'Untitled Group',
                ];
            })->values();

            return response()->json([
                'success' => true,
                'groups' => $formattedGroups,
            ]);
        } catch (\Exception $e) {
            \Log::error('Failed to get user groups', [
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve groups',
                'groups' => [],
            ], 500);
        }
    }

    /**
     * Get user profile
     */
    public function getUserProfile(string $userId)
    {
        try {
            $user = User::find($userId);

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found',
                ], 404);
            }

            $avatarUrl = null;
            if (isset($user->image) && !empty(trim($user->image))) {
                $avatarUrl = $this->getImageUrl('storage/' . ltrim($user->image, '/'));
            }

            return response()->json([
                'success' => true,
                'user' => [
                    'id' => (string)$user->_id,
                    'name' => $user->name ?? $user->email ?? 'Unknown',
                    'email' => $user->email ?? '',
                    'avatar' => $avatarUrl,
                ],
            ]);
        } catch (\Exception $e) {
            \Log::error('Failed to get user profile', [
                'error' => $e->getMessage(),
                'user_id' => $userId,
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve user profile',
            ], 500);
        }
    }
}

