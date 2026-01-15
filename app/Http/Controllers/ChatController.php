<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\User;
use App\Models\Group;
use App\Models\Teams;
use App\Services\AgoraService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ChatController extends Controller
{
    protected $agoraService;
    protected $baseUrl = 'https://logiadmin.it-supportline.de';

    public function __construct(AgoraService $agoraService)
    {
        $this->agoraService = $agoraService;
    }
    
    /**
     * Get full image URL with base URL
     */
    private function getImageUrl($path)
    {
        if (empty($path)) {
            return null;
        }
        
        $path = ltrim($path, '/');
        
        // If path already starts with http, return as is
        if (strpos($path, 'http') === 0) {
            return $path;
        }
        
        // If it's a storage path, use storage URL
        if (strpos($path, 'storage/') === 0) {
            return $this->baseUrl . '/' . $path;
        }
        
        // If it's a build path, use build URL
        if (strpos($path, 'build/') === 0) {
            return $this->baseUrl . '/' . $path;
        }

        // If it's an upload path (users/...), UNLESS it's specifically in storage
        if (strpos($path, 'upload/') === 0 || strpos($path, 'users/') === 0) {
             return $this->baseUrl . '/' . $path;
        }
        
        // Default: assume it's a storage path
        return $this->baseUrl . '/storage/' . $path;
    }

    /**
     * Get chat view
     */
    public function index()
    {
        $headers = \App\Models\Setting::all();
        $setting = \App\Models\Setting::first();
        $user = Auth::user();
        
        // Get conversations list
        $conversations = $this->getConversations($user->_id);
        
        // Get groups where user is a member (in member_ids) or is admin
        $userId = (string)$user->_id;
        
        try {
            // Get all groups first
            $allGroups = Group::all();
            
            \Log::info('Groups query executed', [
                'count' => $allGroups->count(),
                'user_id' => $userId,
                'connection' => 'mongodb',
                'collection' => 'groups'
            ]);
            
            // Filter groups where user is a member or admin
            $filteredGroups = $allGroups->filter(function($group) use ($userId) {
                // Check if user is admin
                if ((string)$group->admin_id === $userId) {
                    return true;
                }
                
                // Handle member_ids - could be array or JSON string
                $memberIds = $group->member_ids ?? [];
                if (is_string($memberIds)) {
                    $decoded = json_decode($memberIds, true);
                    $memberIds = is_array($decoded) ? $decoded : [];
                }
                
                // Convert all member IDs to strings for comparison
                $memberIds = array_map('strval', $memberIds);
                
                // Check if user ID is in member_ids
                $isMember = in_array($userId, $memberIds);
                
                \Log::info('Group membership check', [
                    'group_id' => (string)$group->_id,
                    'group_name' => $group->name,
                    'user_id' => $userId,
                    'is_admin' => (string)$group->admin_id === $userId,
                    'is_member' => $isMember,
                    'member_ids' => $memberIds
                ]);
                
                return $isMember;
            });
            
            \Log::info('Filtered groups', [
                'total_groups' => $allGroups->count(),
                'filtered_count' => $filteredGroups->count(),
                'user_id' => $userId
            ]);
            
            if ($filteredGroups->count() > 0) {
                \Log::info('Groups found for user', [
                    'first_group_id' => (string)$filteredGroups->first()->_id,
                    'first_group_name' => $filteredGroups->first()->name
                ]);
            } else {
                \Log::warning('No groups found for user', ['user_id' => $userId]);
            }
        } catch (\Exception $e) {
            \Log::error('Error fetching groups', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'user_id' => $userId
            ]);
            $filteredGroups = collect([]);
        }
        
        $groupReadTimestamps = $user->group_read_timestamps ?? [];
        if (is_string($groupReadTimestamps)) {
            $groupReadTimestamps = json_decode($groupReadTimestamps, true) ?? [];
        }
        
        $groups = $filteredGroups->map(function($group) use ($userId, $groupReadTimestamps) {
            // Load team separately
            $team = null;
            if ($group->team_id) {
                try {
                    $team = Teams::find($group->team_id);
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
            
            $groupId = (string) $group->_id;
            $lastReadAt = $groupReadTimestamps[$groupId] ?? null;
            
            $unreadCount = 0;
            $query = ChatMessage::where(function($q) use ($groupId) {
                    $q->where('group_id', $groupId)
                      ->orWhere('conversation_id', 'group_' . $groupId);
                })
                ->where('sender_id', '!=', $userId)
                ->where('is_deleted', '!=', true);
            
            if ($lastReadAt) {
                try {
                    $readTime = is_string($lastReadAt) ? new \Carbon\Carbon($lastReadAt) : $lastReadAt;
                    $query->where('created_at', '>', $readTime);
                } catch (\Exception $e) {
                    // If timestamp parsing fails, count all messages
                }
            }
            
            $unreadCount = $query->count();
            
            return [
                'id' => $groupId,
                'name' => $group->name ?? 'Untitled Group',
                'team_id' => $group->team_id,
                'team_photo' => $team && isset($team->thumb_path) && $team->thumb_path
                    ? $this->getImageUrl(ltrim($team->thumb_path, '/'))
                    : $this->getImageUrl('build/img/profile.svg'),
                'team_banner' => $team && isset($team->banner_path) && $team->banner_path
                    ? $this->getImageUrl(ltrim($team->banner_path, '/'))
                    : $this->getImageUrl('build/img/bgractangle.svg'),
                'member_count' => $memberCount,
                'unread_count' => $unreadCount,
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
            $avatarUrl = isset($user->image) && $user->image ? $this->getImageUrl($user->image) : null;
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
        ->orderBy('created_at', 'desc')
        ->get()
        ->groupBy('conversation_id')
        ->map(function ($messages) use ($userId) {
            $lastMessage = $messages->first();
            $otherUserId = $lastMessage->from_user_id === $userId 
                ? $lastMessage->to_user_id 
                : $lastMessage->from_user_id;
            
            $otherUser = User::find($otherUserId);
            
            return [
                'conversation_id' => $lastMessage->conversation_id,
                'other_user' => $otherUser ? [
                    'id' => (string)$otherUser->_id,
                    'name' => $otherUser->name ?? $otherUser->email,
                    'avatar' => isset($otherUser->image) && $otherUser->image 
                        ? $this->getImageUrl($otherUser->image) 
                        : null,
                ] : null,
                'last_message' => [
                    'content' => $lastMessage->content,
                    'created_at' => $lastMessage->created_at,
                ],
                'unread_count' => $messages->where('to_user_id', $userId)
                    ->where('is_read', false)
                    ->count(),
            ];
        })
        ->values();

        return $conversations;
    }

    /**
     * Get all groups for the current user (API endpoint)
     */
    public function getGroups()
    {
        try {
            $user = Auth::user();
            $userId = (string)$user->_id;
            
            // Get all groups
            $allGroups = Group::all();
            
            // Filter groups where user is admin or member
            $filteredGroups = $allGroups->filter(function($group) use ($userId) {
                $isAdmin = (string)$group->admin_id === $userId;
                
                $memberIds = $group->member_ids ?? [];
                if (is_string($memberIds)) {
                    $decoded = json_decode($memberIds, true);
                    $memberIds = is_array($decoded) ? $decoded : [];
                }
                $memberIds = array_map('strval', $memberIds);
                $isMember = in_array($userId, $memberIds);
                
                return $isAdmin || $isMember;
            });
            
            $groups = $filteredGroups->map(function($group) {
                return [
                    '_id' => (string)$group->_id,
                    'id' => (string)$group->_id,
                    'name' => $group->name ?? 'Group',
                    'photo' => $group->photo ?? null,
                ];
            });
            
            return response()->json([
                'success' => true,
                'groups' => $groups->values(),
            ]);
        } catch (\Exception $e) {
            \Log::error('Failed to get groups', [
                'error' => $e->getMessage(),
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to load groups',
            ], 500);
        }
    }

    /**
     * Get group messages
     */
    public function getGroupMessages($groupId)
    {
        try {
            $user = Auth::user();
            $userId = (string)$user->_id;
            
            // Verify user is member of group
            $group = Group::find($groupId);
            if (!$group) {
                return response()->json([
                    'success' => false,
                    'message' => 'Group not found',
                ], 404);
            }
            
            // Check if user is admin
            $isAdmin = (string)$group->admin_id === $userId;
            
            // Check if user is in member_ids
            $memberIds = $group->member_ids ?? [];
            if (is_string($memberIds)) {
                $decoded = json_decode($memberIds, true);
                $memberIds = is_array($decoded) ? $decoded : [];
            }
            $memberIds = array_map('strval', $memberIds);
            $isMember = in_array($userId, $memberIds);
            
            if (!$isAdmin && !$isMember) {
                return response()->json([
                    'success' => false,
                    'message' => 'You are not a member of this group',
                ], 403);
            }

            // Get last_id from request for polling
            $lastId = request()->query('last_id');
            
            // Build query for messages
            $query = ChatMessage::where(function($query) use ($groupId) {
                    $query->where('group_id', $groupId)
                          ->orWhere('conversation_id', 'group_' . $groupId);
                });
            
            // If last_id is provided, only get messages after that ID
            if ($lastId) {
                $lastMessage = ChatMessage::find($lastId);
                if ($lastMessage) {
                    $query->where('created_at', '>', $lastMessage->created_at);
                }
            }
            
            // Get messages
            $messages = $query->orderBy('created_at', 'asc')
                ->limit(100)
                ->get();

            // Format messages
            $formattedMessages = $messages->map(function($message) use ($user) {
                $senderId = $message->sender_id ?? $message->from_user_id;
                $sender = null;
                $senderAvatar = null;
                
                // Fetch sender with proper error handling
                if ($senderId) {
                    try {
                        $sender = User::find($senderId);
                        if ($sender && isset($sender->image)) {
                            $imagePath = trim($sender->image);
                            if (!empty($imagePath)) {
                                $senderAvatar = $this->getImageUrl(ltrim($imagePath, '/'));
                            }
                        }
                    } catch (\Exception $e) {
                        \Log::warning('Failed to fetch sender for message', [
                            'sender_id' => $senderId,
                            'message_id' => (string)$message->_id,
                            'error' => $e->getMessage()
                        ]);
                    }
                }
                
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
                    'sender_id' => (string)($senderId ?? ''),
                    'from_user_id' => (string)($senderId ?? ''),
                    'sender_name' => $sender ? ($sender->name ?? $sender->email) : 'Unknown',
                    'sender_avatar' => $senderAvatar,
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
            $userId = (string)$user->_id;
            
            $request->validate([
                'group_id' => 'required|string',
                'content' => 'nullable|string',
                'message_type' => 'required|in:txt,img,file,audio,video',
                'file_url' => 'nullable|string',
                'file_name' => 'nullable|string',
                'file_size' => 'nullable|integer',
                'replied_to_message_id' => 'nullable|string',
            ]);

            // Verify user is member of group
            $group = Group::find($request->group_id);
            if (!$group) {
                return response()->json([
                    'success' => false,
                    'message' => 'Group not found',
                ], 404);
            }
            
            // Check if user is admin
            $isAdmin = (string)$group->admin_id === $userId;
            
            // Check if user is in member_ids
            $memberIds = $group->member_ids ?? [];
            if (is_string($memberIds)) {
                $decoded = json_decode($memberIds, true);
                $memberIds = is_array($decoded) ? $decoded : [];
            }
            $memberIds = array_map('strval', $memberIds);
            $isMember = in_array($userId, $memberIds);
            
            if (!$isAdmin && !$isMember) {
                return response()->json([
                    'success' => false,
                    'message' => 'You are not a member of this group',
                ], 403);
            }

            // Create message
            $message = new ChatMessage();
            $message->sender_id = $user->_id;
            $message->from_user_id = $user->_id;
            $message->group_id = $request->group_id;
            $message->conversation_id = 'group_' . $request->group_id;
            $message->message_type = $request->message_type;
            $message->content = $request->content;
            $message->file_url = $request->file_url;
            $message->file_name = $request->file_name;
            $message->file_size = $request->file_size;
            $message->replied_to_message_id = $request->replied_to_message_id;
            $message->reply_to_message_id = $request->replied_to_message_id;
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
     * Get group members for mentions
     */
    public function getGroupMembers($groupId)
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
            $memberIds = $group->member_ids ?? [];
            if (is_string($memberIds)) {
                $decoded = json_decode($memberIds, true);
                $memberIds = is_array($decoded) ? $decoded : [];
            }
            $memberIds = array_map('strval', $memberIds);
            $isAdmin = (string)$group->admin_id === $userId;
            $isMember = in_array($userId, $memberIds);
            
            if (!$isAdmin && !$isMember) {
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
                $avatarUrl = null;
                if (isset($member->image) && !empty(trim($member->image))) {
                    $avatarUrl = $this->getImageUrl(ltrim($member->image, '/'));
                } elseif (isset($member->profile_image) && !empty(trim($member->profile_image))) {
                    $avatarUrl = $this->getImageUrl('storage/' . ltrim($member->profile_image, '/'));
                }

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
     * Get user profile by ID
     */
    public function getUserProfile($userId)
    {
        try {
            $user = User::find($userId);
            
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'user' => [
                    'id' => (string)$user->_id,
                    'name' => $user->name ?? $user->email ?? 'Unknown',
                    'email' => $user->email ?? '',
                    'avatar' => isset($user->image) && !empty(trim($user->image)) ? $this->getImageUrl(ltrim($user->image, '/')) : null,
                ],
            ]);
        } catch (\Exception $e) {
            \Log::error('Failed to get user profile', [
                'error' => $e->getMessage(),
                'user_id' => $userId,
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to load user profile',
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
            'sender_id' => (string)($senderId ?? ''),
            'sender_name' => $sender ? ($sender->name ?? $sender->email) : 'Unknown',
            'sender_avatar' => $sender && isset($sender->image) && $sender->image ? $this->getImageUrl($sender->image) : null,
            'content' => $message->content,
            'message_type' => $message->message_type ?? 'txt',
            'file_url' => $message->file_url,
            'file_name' => $message->file_name,
            'file_size' => $message->file_size,
            'reactions' => $message->reactions ?? [],
            'replied_to_message' => $repliedTo,
            'created_at' => $message->created_at->toIso8601String(),
        ];
    }

    public function markGroupAsRead($groupId)
    {
        try {
            $user = Auth::user();
            $userId = (string)$user->_id;
            
            $group = Group::find($groupId);
            if (!$group) {
                return response()->json(['success' => false, 'message' => 'Group not found'], 404);
            }
            
            $memberIds = $group->member_ids ?? [];
            if (is_string($memberIds)) {
                $memberIds = json_decode($memberIds, true) ?? [];
            }
            $memberIds = array_map('strval', $memberIds);
            $isMember = in_array($userId, $memberIds) || (string)$group->admin_id === $userId;
            
            if (!$isMember) {
                return response()->json(['success' => false, 'message' => 'Not a member'], 403);
            }
            
            $groupReadTimestamps = $user->group_read_timestamps ?? [];
            if (is_string($groupReadTimestamps)) {
                $groupReadTimestamps = json_decode($groupReadTimestamps, true) ?? [];
            }
            
            $groupReadTimestamps[(string)$groupId] = now();
            $user->group_read_timestamps = $groupReadTimestamps;
            $user->save();
            
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function getGroupUnreadCounts()
    {
        try {
            $user = Auth::user();
            $userId = (string)$user->_id;
            
            $allGroups = Group::all();
            $filteredGroups = $allGroups->filter(function($group) use ($userId) {
                if ((string)$group->admin_id === $userId) {
                    return true;
                }
                $memberIds = $group->member_ids ?? [];
                if (is_string($memberIds)) {
                    $memberIds = json_decode($memberIds, true) ?? [];
                }
                $memberIds = array_map('strval', $memberIds);
                return in_array($userId, $memberIds);
            });
            
            $groupReadTimestamps = $user->group_read_timestamps ?? [];
            if (is_string($groupReadTimestamps)) {
                $groupReadTimestamps = json_decode($groupReadTimestamps, true) ?? [];
            }
            
            $unreadCounts = [];
            foreach ($filteredGroups as $group) {
                $groupId = (string) $group->_id;
                $lastReadAt = $groupReadTimestamps[$groupId] ?? null;
                
                $query = ChatMessage::where(function($q) use ($groupId) {
                        $q->where('group_id', $groupId)
                          ->orWhere('conversation_id', 'group_' . $groupId);
                    })
                    ->where('sender_id', '!=', $userId)
                    ->where('is_deleted', '!=', true);
                
                if ($lastReadAt) {
                    try {
                        $readTime = is_string($lastReadAt) ? new \Carbon\Carbon($lastReadAt) : $lastReadAt;
                        $query->where('created_at', '>', $readTime);
                    } catch (\Exception $e) {
                    }
                }
                
                $count = $query->count();
                if ($count > 0) {
                    $unreadCounts[$groupId] = $count;
                }
            }
            
            return response()->json(['success' => true, 'unread_counts' => $unreadCounts]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Get all users with online status
     */
    public function getAllUsers(Request $request)
    {
        // Get all users
        $users = User::where('email', '!=', 'admin@gmail.com')->get();

        // Users are considered online if they were active in the last X minutes
        $onlineThresholdMinutes = 2; // Adjust this value
        $activeThreshold = now()->subMinutes($onlineThresholdMinutes);

        $usersList = $users->map(function($user) use ($activeThreshold) {
            $userId = (string)$user->_id;

            // Check if user is currently logged in
            $isCurrentUser = Auth::check() && (string)Auth::id() === $userId;

            // Check if user has recent activity
            $hasRecentActivity = false;
            if ($user->last_activity) {
                $hasRecentActivity = $user->last_activity->isAfter($activeThreshold);
            }

            // Consider online if:
            // 1. Has recent activity (within threshold), OR
            // 2. Is the current logged-in user, OR
            // 3. User is active AND has last_activity
            $isOnline = $hasRecentActivity || $isCurrentUser || ($user->active && $user->last_activity);

            // Get avatar URL
            $avatarUrl = null;
            if (isset($user->image) && !empty(trim($user->image))) {
                $avatarUrl = $this->getImageUrl(ltrim($user->image, '/'));
            } elseif (isset($user->profile_image) && !empty(trim($user->profile_image))) {
                $avatarUrl = $this->getImageUrl('storage/' . ltrim($user->profile_image, '/'));
            }

            return [
                'id' => $userId,
                'name' => $user->name ?? $user->email,
                'avatar' => $avatarUrl,
                'is_online' => $isOnline,  // ✅ This determines green indicator
            ];
        });

        return response()->json([
            'success' => true,
            'users' => $usersList->values(),
        ]);
    }
}

