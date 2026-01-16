<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\User;
use App\Models\Group;
use App\Models\Team;
use App\Models\Project;
use App\Models\Favorite;
use App\Services\AgoraService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
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
        
        $groups = $allGroups->map(function($group) use ($user) {
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
            
            // Get unread message count for this group
            $unreadCount = ChatMessage::getGroupUnreadCount((string)$group->_id, (string)$user->_id);
            
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
                'unread_count' => $unreadCount,
            ];
        })
        ->values();
        
        \Log::info('Final groups prepared for view', [
            'count' => $groups->count(),
            'groups' => $groups->toArray()
        ]);
        
        // Get projects, teams, and users for todo modal
        $projects = Project::all();
        $teams = Team::all();
        $users = User::whereIn('type', ['employee', 'developer'])
                     ->where('_id', '!=', $user->_id)
                     ->where('completed', '!=', '1')
                     ->get();
        
        return view('Chats.chat', compact('headers', 'setting', 'conversations', 'groups', 'projects', 'teams', 'users'));
    }

    /**
     * Get Agora token for current user
     */
    public function getToken(Request $request)
    {
        $user = Auth::user();
        $userId = (string)$user->_id;

        try {
            // Create or get Agora user (non-blocking - continue even if it fails)
            $avatarUrl = $this->getAvatarUrl($user);
            try {
                $this->agoraService->createUser($userId, $user->name ?? $user->email, $avatarUrl);
            } catch (\Exception $e) {
                // Log but continue - user might already exist or API might be temporarily unavailable
                \Log::warning('Agora user creation had issues, but continuing', [
                    'user_id' => $userId,
                    'error' => $e->getMessage(),
                ]);
            }

            // Generate chat token (this is the critical part)
            $tokenResponse = $this->agoraService->generateChatToken($userId);

            $token = $tokenResponse['token'] ?? $tokenResponse['accessToken'] ?? $tokenResponse['rtmToken'] ?? null;
            
            if (!$token) {
                \Log::error('Agora token generation returned no token', [
                    'user_id' => $userId,
                    'response' => $tokenResponse,
                ]);
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to generate chat token',
                ], 500);
            }

            return response()->json([
                'success' => true,
                'app_id' => config('agora.app_id'),
                'user_id' => $userId,
                'token' => $token,
                'username' => $user->name ?? $user->email,
                'avatar' => $avatarUrl,
            ]);
        } catch (\Exception $e) {
            \Log::error('Agora token generation failed', [
                'user_id' => $userId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Failed to generate Agora token',
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
            'file' => 'required|file|max:51200', // 50MB max for documents
            'type' => 'required|in:image,file,audio,video',
            'group_id' => 'nullable|string', // Optional group_id for group chats
        ]);

        $file = $request->file('file');
        $type = $request->type;
        
        // Determine storage type based on file MIME type
        $mimeType = $file->getMimeType();
        $storageType = $type;
        
        // If type is 'file', determine subdirectory based on file extension
        if ($type === 'file') {
            $extension = strtolower($file->getClientOriginalExtension());
            if (in_array($extension, ['pdf'])) {
                $storageType = 'file/pdf';
            } elseif (in_array($extension, ['doc', 'docx'])) {
                $storageType = 'file/word';
            } elseif (in_array($extension, ['xls', 'xlsx'])) {
                $storageType = 'file/excel';
            } elseif (in_array($extension, ['ppt', 'pptx'])) {
                $storageType = 'file/powerpoint';
            } else {
                $storageType = 'file/documents';
            }
        }
        
        $fileName = Str::random(20) . '_' . time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('chat/' . $storageType, $fileName, 'public');

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
        
        if (!$message) {
            return response()->json(['error' => 'Message not found'], 404);
        }

        // Check if user is the sender (handle both from_user_id and sender_id for group messages)
        $senderId = (string)($message->sender_id ?? $message->from_user_id ?? '');
        if ($senderId !== $userId) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Soft delete the message
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
     * Get users who reacted with a specific emoji
     */
    public function getReactionUsers($messageId, $emoji)
    {
        $message = ChatMessage::find($messageId);
        if (!$message) {
            return response()->json(['success' => false, 'message' => 'Message not found'], 404);
        }

        $reactions = $message->reactions ?? [];
        $userIds = [];

        // Find all user IDs who reacted with this emoji
        foreach ($reactions as $reaction) {
            if (isset($reaction['emoji']) && $reaction['emoji'] === $emoji) {
                $userIds[] = $reaction['user_id'] ?? null;
            }
        }

        // Remove nulls and duplicates
        $userIds = array_filter(array_unique($userIds));

        // Fetch user details
        $users = User::whereIn('_id', $userIds)->get()->map(function ($user) {
            return [
                'id' => (string)$user->_id,
                'name' => $user->name ?? null,
                'email' => $user->email ?? null,
                'avatar' => $this->getAvatarUrl($user),
            ];
        });

        return response()->json([
            'success' => true,
            'users' => $users->values()->all(),
        ]);
    }

    /**
     * Format message for API response
     */
    private function formatMessage($message)
    {
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
            
            // Build query - exclude deleted messages
            $query = ChatMessage::where(function($q) use ($groupId) {
                    $q->where('group_id', $groupId)
                      ->orWhere('conversation_id', 'group_' . $groupId);
                })
                ->where(function($q) {
                    $q->where('is_deleted', false)
                      ->orWhereNull('is_deleted');
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

            // Only mark messages as read if explicitly requested (when user actually opens the chat)
            // Don't mark as read when just checking messages or polling
            $markAsRead = $request->input('mark_as_read', false);
            if ($markAsRead === true || $markAsRead === 'true' || $markAsRead === '1') {
                $userId = (string)$user->_id;
                ChatMessage::markGroupMessagesAsRead($groupId, $userId);
                \Log::info('Marking group messages as read', [
                    'group_id' => $groupId,
                    'user_id' => $userId,
                    'reason' => 'mark_as_read parameter was true'
                ]);
            }

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
     * Get group media (images, videos, documents, links)
     */
    public function getGroupMedia($groupId, Request $request)
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

            // Get all messages with media for this group
            $messages = ChatMessage::where(function($q) use ($groupId) {
                    $q->where('group_id', $groupId)
                      ->orWhere('conversation_id', 'group_' . $groupId);
                })
                ->where(function($q) {
                    $q->where('is_deleted', false)
                      ->orWhereNull('is_deleted');
                })
                ->whereIn('message_type', ['img', 'file', 'video', 'audio'])
                ->whereNotNull('file_url')
                ->orderBy('created_at', 'desc')
                ->get();

            // Categorize media
            $photos = [];
            $videos = [];
            $documents = [];
            $links = [];

            foreach ($messages as $message) {
                $mediaItem = [
                    'id' => (string)$message->_id,
                    'file_url' => $message->file_url,
                    'file_name' => $message->file_name ?? 'Untitled',
                    'file_size' => $message->file_size ?? 0,
                    'message_type' => $message->message_type,
                    'created_at' => $message->created_at->toIso8601String(),
                ];

                // Get sender info
                $senderId = $message->sender_id ?? $message->from_user_id;
                if ($senderId) {
                    $sender = User::find($senderId);
                    if ($sender) {
                        $mediaItem['sender_name'] = $sender->name ?? $sender->email;
                        $mediaItem['sender_avatar'] = $this->getAvatarUrl($sender);
                    }
                }

                // Categorize by message type
                if ($message->message_type === 'img') {
                    $photos[] = $mediaItem;
                } elseif ($message->message_type === 'video') {
                    $videos[] = $mediaItem;
                } elseif ($message->message_type === 'file') {
                    $documents[] = $mediaItem;
                }
            }

            // Extract links from text messages
            $textMessages = ChatMessage::where(function($q) use ($groupId) {
                    $q->where('group_id', $groupId)
                      ->orWhere('conversation_id', 'group_' . $groupId);
                })
                ->where(function($q) {
                    $q->where('is_deleted', false)
                      ->orWhereNull('is_deleted');
                })
                ->where('message_type', 'txt')
                ->whereNotNull('content')
                ->orderBy('created_at', 'desc')
                ->get();

            // Add message_id to all media items for favorite functionality
            foreach ($photos as &$photo) {
                $photo['message_id'] = $photo['id'];
            }
            foreach ($videos as &$video) {
                $video['message_id'] = $video['id'];
            }
            foreach ($documents as &$doc) {
                $doc['message_id'] = $doc['id'];
            }

            // Simple URL regex pattern
            $urlPattern = '/(https?:\/\/[^\s]+)/i';
            foreach ($textMessages as $message) {
                if (preg_match_all($urlPattern, $message->content, $matches)) {
                    foreach ($matches[0] as $url) {
                        $linkItem = [
                            'id' => (string)$message->_id . '_' . md5($url),
                            'url' => $url,
                            'message_id' => (string)$message->_id,
                            'created_at' => $message->created_at->toIso8601String(),
                        ];

                        // Get sender info
                        $senderId = $message->sender_id ?? $message->from_user_id;
                        if ($senderId) {
                            $sender = User::find($senderId);
                            if ($sender) {
                                $linkItem['sender_name'] = $sender->name ?? $sender->email;
                                $linkItem['sender_avatar'] = $this->getAvatarUrl($sender);
                            }
                        }

                        $links[] = $linkItem;
                    }
                }
            }

            return response()->json([
                'success' => true,
                'media' => [
                    'photos' => $photos,
                    'videos' => $videos,
                    'documents' => $documents,
                    'links' => $links,
                ],
                'counts' => [
                    'photos' => count($photos),
                    'videos' => count($videos),
                    'documents' => count($documents),
                    'links' => count($links),
                ],
            ]);
        } catch (\Exception $e) {
            \Log::error('Failed to get group media', [
                'error' => $e->getMessage(),
                'group_id' => $groupId,
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to load media',
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
        if (!$user) {
            return null;
        }
        
        // Check image field first (stored in public/upload/users/) for consistency
        if (isset($user->image) && !empty(trim($user->image))) {
            $image = ltrim($user->image, '/');
            
            // Check if it starts with upload/ (public folder)
            if (strpos($image, 'upload/') === 0) {
                // Check public/upload/...
                if (file_exists(public_path($image))) {
                    return asset($image);
                }
                // If not in public, try storage
                if (file_exists(storage_path('app/public/' . $image))) {
                    return asset('storage/' . $image);
                }
                // Default to public path
                return asset($image);
            } else {
                // Already has storage path or other format
                // Check storage/app/public/...
                if (file_exists(storage_path('app/public/' . $image))) {
                    return asset('storage/' . $image);
                }
                // Default to storage path
                return asset('storage/' . $image);
            }
        }
        
        // Fallback to profile_image (stored in storage/app/public/profiles/)
        if (isset($user->profile_image) && !empty(trim($user->profile_image))) {
            $image = ltrim($user->profile_image, '/');
            // Check storage/app/public/...
            if (file_exists(storage_path('app/public/' . $image))) {
                return asset('storage/' . $image);
            }
            // Default to storage path
            return asset('storage/' . $image);
        }
        
        return null;
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

            $formattedGroups = $userGroups->map(function($group) use ($userId) {
                // Get unread message count for this group
                $unreadCount = ChatMessage::getGroupUnreadCount((string)$group->_id, $userId);
                
                return [
                    '_id' => (string)$group->_id,
                    'id' => (string)$group->_id,
                    'name' => $group->name ?? 'Untitled Group',
                    'unread_count' => $unreadCount,
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
     * Get group members for mentions
     */
    public function getGroupMembersForMentions($groupId)
    {
        try {
            $user = Auth::user();
            $userId = (string)$user->_id;

            // Find the group
            $group = Group::find($groupId);
            if (!$group) {
                return response()->json([
                    'success' => false,
                    'message' => 'Group not found',
                ], 404);
            }

            // Verify user is member of group
            $memberIds = array_map('strval', $group->member_ids ?? []);
            $isMember = in_array($userId, $memberIds) || (string)$group->admin_id === $userId;
            
            if (!$isMember) {
                return response()->json([
                    'success' => false,
                    'message' => 'You are not a member of this group',
                ], 403);
            }

            // Get all member IDs (including admin)
            $allMemberIds = array_map('strval', $memberIds);
            if ($group->admin_id && !in_array((string)$group->admin_id, $allMemberIds)) {
                $allMemberIds[] = (string)$group->admin_id;
            }

            // Fetch all members
            $members = User::whereIn('_id', $allMemberIds)->get();

            // Format members
            $formattedMembers = $members->map(function($member) {
                $avatarUrl = $this->getAvatarUrl($member);

                return [
                    'id' => (string)$member->_id,
                    'name' => $member->name ?? $member->email ?? 'Unknown',
                    'email' => $member->email ?? '',
                    'avatar' => $avatarUrl,
                ];
            });

            return response()->json([
                'success' => true,
                'members' => $formattedMembers,
            ]);
        } catch (\Exception $e) {
            \Log::error('Failed to get group members', [
                'error' => $e->getMessage(),
                'group_id' => $groupId,
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve group members',
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

            $avatarUrl = $this->getAvatarUrl($user);

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

    /**
     * Get group profile/details
     */
    public function getGroupProfile(string $groupId)
    {
        try {
            $user = Auth::user();
            $userId = (string)$user->_id;

            // Find the group
            $group = Group::find($groupId);
            if (!$group) {
                return response()->json([
                    'success' => false,
                    'message' => 'Group not found',
                ], 404);
            }

            // Verify user is member of group
            $memberIds = array_map('strval', $group->member_ids ?? []);
            $isMember = in_array($userId, $memberIds) || (string)$group->admin_id === $userId;
            
            if (!$isMember) {
                return response()->json([
                    'success' => false,
                    'message' => 'You are not a member of this group',
                ], 403);
            }

            // Get admin user
            $admin = null;
            $adminEmail = '';
            if ($group->admin_id) {
                $admin = User::find($group->admin_id);
                if ($admin) {
                    $adminEmail = $admin->email ?? '';
                }
            }

            // Get team if exists
            $team = null;
            $teamPhoto = asset('build/img/profiles/avatar-06.jpg');
            if ($group->team_id) {
                $team = Team::find($group->team_id);
                if ($team && $team->thumb_path) {
                    $teamPhoto = asset('storage/' . ltrim($team->thumb_path, '/'));
                }
            }

            // Get member count
            $memberCount = count($memberIds) + 1; // +1 for admin

            return response()->json([
                'success' => true,
                'group' => [
                    'id' => (string)$group->_id,
                    'name' => $group->name ?? 'Untitled Group',
                    'description' => $group->description ?? '',
                    'email' => $adminEmail,
                    'photo' => $teamPhoto,
                    'member_count' => $memberCount,
                    'admin_name' => $admin ? ($admin->name ?? $admin->email ?? 'Unknown') : 'Unknown',
                ],
            ]);
        } catch (\Exception $e) {
            \Log::error('Failed to get group profile', [
                'error' => $e->getMessage(),
                'group_id' => $groupId,
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve group profile',
            ], 500);
        }
    }

    /**
     * Toggle favorite status for a media item
     */
    public function toggleFavorite(Request $request)
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized',
                ], 401);
            }

            $userId = (string)$user->_id;
            $messageId = $request->input('message_id');
            $groupId = $request->input('group_id');
            $mediaType = $request->input('media_type'); // 'photo', 'video', 'document', 'link', 'audio'
            $fileUrl = $request->input('file_url');
            $fileName = $request->input('file_name');
            $url = $request->input('url'); // For links

            if (!$messageId || !$mediaType) {
                return response()->json([
                    'success' => false,
                    'message' => 'Missing required fields',
                ], 400);
            }

            // Check if already favorited
            $existing = Favorite::where('user_id', $userId)
                ->where('message_id', $messageId)
                ->first();

            if ($existing) {
                // Remove favorite
                $existing->delete();
                return response()->json([
                    'success' => true,
                    'is_favorite' => false,
                    'message' => 'Removed from favorites',
                ]);
            } else {
                // Add favorite
                $favorite = Favorite::create([
                    'user_id' => $userId,
                    'message_id' => $messageId,
                    'group_id' => $groupId,
                    'media_type' => $mediaType,
                    'file_url' => $fileUrl,
                    'file_name' => $fileName,
                    'url' => $url,
                ]);

                return response()->json([
                    'success' => true,
                    'is_favorite' => true,
                    'message' => 'Added to favorites',
                    'favorite' => $favorite,
                ]);
            }
        } catch (\Exception $e) {
            \Log::error('Error toggling favorite: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to toggle favorite',
            ], 500);
        }
    }

    /**
     * Get all favorites for the current user
     */
    public function getFavorites(Request $request)
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized',
                ], 401);
            }

            $userId = (string)$user->_id;
            $groupId = $request->input('group_id');

            $query = Favorite::where('user_id', $userId);
            if ($groupId) {
                $query->where('group_id', $groupId);
            }

            $favorites = $query->get();

            // Get favorite message IDs for quick lookup
            $favoriteMessageIds = $favorites->pluck('message_id')->toArray();

            return response()->json([
                'success' => true,
                'favorites' => $favorites,
                'favorite_message_ids' => $favoriteMessageIds,
            ]);
        } catch (\Exception $e) {
            \Log::error('Error getting favorites: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to get favorites',
            ], 500);
        }
    }

    /**
     * Get unread message counts for all user groups
     */
    public function getGroupsUnreadCounts()
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

            // Get unread counts for each group
            $unreadCounts = [];
            foreach ($userGroups as $group) {
                $groupId = (string)$group->_id;
                $unreadCount = ChatMessage::getGroupUnreadCount($groupId, $userId);
                $unreadCounts[$groupId] = $unreadCount;
            }

            return response()->json([
                'success' => true,
                'unread_counts' => $unreadCounts,
            ]);
        } catch (\Exception $e) {
            \Log::error('Failed to get groups unread counts', [
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve unread counts',
                'unread_counts' => [],
            ], 500);
        }
    }

    /**
     * Get all users with online status
     */
    public function getAllUsers(Request $request)
    {
        try {
            // Get all users (excluding superadmin if needed)
            $users = User::where('email', '!=', 'admin@gmail.com')->get();

            // Users are considered online if they were active in the last X minutes
            $onlineThresholdMinutes = 2; // Adjust this value to change online status duration
            $activeThreshold = now()->subMinutes($onlineThresholdMinutes);
            
            // Map all users with online status based on last_activity field
            $usersList = $users->map(function($user) use ($activeThreshold) {
                $avatarUrl = $this->getAvatarUrl($user);
                $userId = (string)$user->_id;
                
                // Check if user is currently logged in
                $isCurrentUser = Auth::check() && (string)Auth::id() === $userId;
                
                // Check if user has recent activity (last_activity within threshold)
                $hasRecentActivity = false;
                if ($user->last_activity) {
                    $hasRecentActivity = $user->last_activity->isAfter($activeThreshold);
                }
                
                // Consider online if:
                // 1. Has recent activity (last_activity within threshold), OR
                // 2. Is the current logged-in user (always online), OR
                // 3. User is marked as active AND has last_activity (fallback)
                $isOnline = $hasRecentActivity || $isCurrentUser || ($user->active && $user->last_activity);
                
                return [
                    'id' => $userId,
                    'name' => $user->name ?? $user->email,
                    'email' => $user->email,
                    'avatar' => $avatarUrl,
                    'is_online' => $isOnline,
                    'type' => $user->type ?? 'user',
                ];
            })->values();

            return response()->json([
                'success' => true,
                'members' => $usersList,
            ]);
        } catch (\Exception $e) {
            \Log::error('Failed to get all users', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve users',
                'members' => [],
            ], 500);
        }
    }

    /**
     * Test endpoint: Create a message as if sent by another user
     * This is for testing notifications - creates messages from other users
     */
    public function createTestMessageAsOtherUser(Request $request)
    {
        try {
            $currentUser = Auth::user();
            $currentUserId = (string)$currentUser->_id;
            
            $request->validate([
                'group_id' => 'required|string',
                'content' => 'required|string',
                'message_type' => 'required|in:txt,img,file,audio,video',
            ]);

            // Get all users except current user
            $otherUsers = User::where('_id', '!=', $currentUserId)
                ->where('email', '!=', 'admin@gmail.com')
                ->get();
            
            if ($otherUsers->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No other users found to simulate message from',
                ], 404);
            }

            // Pick a random other user
            $senderUser = $otherUsers->random();
            $senderUserId = (string)$senderUser->_id;

            // Verify group exists
            $group = Group::find($request->group_id);
            if (!$group) {
                return response()->json([
                    'success' => false,
                    'message' => 'Group not found',
                ], 404);
            }

            // Create message as if sent by the other user
            $message = new ChatMessage();
            $message->sender_id = $senderUserId;
            $message->from_user_id = $senderUserId;
            $message->group_id = $request->group_id;
            $message->conversation_id = 'group_' . $request->group_id;
            $message->message_type = $request->message_type;
            $message->content = $request->content;
            $message->file_url = $request->file_url ?? null;
            $message->file_name = $request->file_name ?? null;
            $message->file_size = $request->file_size ?? null;
            $message->replied_to_message_id = $request->replied_to_message_id ?? null;
            $message->reply_to_message_id = $request->replied_to_message_id ?? null;
            $message->message_id = 'test_' . uniqid(); // Test message ID
            $message->reactions = [];
            $message->is_read = false; // Mark as unread so it triggers notifications
            $message->is_deleted = false; // Explicitly mark as not deleted
            $message->save();

            // Verify the message was saved correctly
            $savedMessage = ChatMessage::find($message->_id);
            $unreadCount = ChatMessage::getGroupUnreadCount($request->group_id, $currentUserId);

            \Log::info('Test message created', [
                'message_id' => (string)$message->_id,
                'sender_id' => $senderUserId,
                'sender_name' => $senderUser->name ?? $senderUser->email,
                'group_id' => $request->group_id,
                'current_user_id' => $currentUserId,
                'is_read' => $message->is_read,
                'saved_is_read' => $savedMessage ? $savedMessage->is_read : 'not found',
                'saved_sender_id' => $savedMessage ? (string)($savedMessage->sender_id ?? $savedMessage->from_user_id) : 'not found',
                'unread_count_after_save' => $unreadCount,
            ]);

            return response()->json([
                'success' => true,
                'message' => $this->formatGroupMessage($message),
                'sender' => [
                    'id' => $senderUserId,
                    'name' => $senderUser->name ?? $senderUser->email,
                ],
            ]);
        } catch (\Exception $e) {
            \Log::error('Failed to create test message', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to create test message: ' . $e->getMessage(),
            ], 500);
        }
    }
}

