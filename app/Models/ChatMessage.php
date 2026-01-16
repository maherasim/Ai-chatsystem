<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class ChatMessage extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'chat_messages';

    protected $fillable = [
        'message_id',           // Agora message ID
        'from_user_id',         // Sender user ID
        'sender_id',            // Sender user ID (alias for from_user_id)
        'to_user_id',           // Receiver user ID (null for group)
        'group_id',             // Group ID (for group messages)
        'conversation_id',      // Conversation/chat ID (unique per chat pair)
        'message_type',         // txt, img, file, audio, video, etc.
        'content',              // Message content/text
        'file_url',             // For file/image/audio/video messages
        'file_name',            // Original file name
        'file_size',            // File size in bytes
        'thumbnail_url',        // For image/video thumbnails
        'replied_to_message_id', // If replying to another message
        'reply_to_message_id',  // If replying to another message (alias)
        'is_forwarded',         // Boolean
        'is_deleted',           // Boolean (soft delete)
        'is_read',              // Boolean
        'read_at',              // Timestamp when read
        'reactions',            // Array of reactions [{user_id, emoji, created_at}]
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'is_forwarded' => 'boolean',
        'is_deleted' => 'boolean',
        'is_read' => 'boolean',
        'read_at' => 'datetime',
        'reactions' => 'array',
        'file_size' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Generate conversation ID for two users
     */
    public static function generateConversationId($userId1, $userId2): string
    {
        $ids = [(string)$userId1, (string)$userId2];
        sort($ids);
        return implode('_', $ids);
    }

    /**
     * Get conversation messages
     */
    public static function getConversationMessages($conversationId, $limit = 50, $beforeMessageId = null)
    {
        $query = static::where('conversation_id', $conversationId)
            ->where('is_deleted', false)
            ->orderBy('created_at', 'desc')
            ->limit($limit);

        if ($beforeMessageId) {
            $beforeMessage = static::find($beforeMessageId);
            if ($beforeMessage) {
                $query->where('created_at', '<', $beforeMessage->created_at);
            }
        }

        return $query->get()->reverse()->values();
    }

    /**
     * Get unread messages count for user
     */
    public static function getUnreadCount($userId, $conversationId = null): int
    {
        $query = static::where('to_user_id', $userId)
            ->where('is_read', false)
            ->where('is_deleted', false);

        if ($conversationId) {
            $query->where('conversation_id', $conversationId);
        }

        return $query->count();
    }

    /**
     * Get unread messages count for a group (messages not read by the user)
     */
    public static function getGroupUnreadCount($groupId, $userId): int
    {
        // Convert IDs to strings for proper MongoDB comparison
        $groupIdStr = (string)$groupId;
        $userIdStr = (string)$userId;
        
        // Get all messages for this group that are not deleted
        $messages = static::where(function($q) use ($groupIdStr) {
                $q->where('group_id', $groupIdStr)
                  ->orWhere('conversation_id', 'group_' . $groupIdStr);
            })
            ->where(function($q) {
                $q->where('is_deleted', false)
                  ->orWhereNull('is_deleted');
            })
            ->get();
        
        // Filter messages where:
        // 1. User is NOT the sender (check both sender_id and from_user_id)
        // 2. is_read is false or null
        $unreadCount = 0;
        foreach ($messages as $message) {
            $senderId = (string)($message->sender_id ?? $message->from_user_id ?? '');
            
            // Skip if user is the sender
            if ($senderId === $userIdStr) {
                continue;
            }
            
            // Count if unread (is_read is false, null, 0, or '0')
            $isRead = $message->is_read;
            if ($isRead === false || $isRead === null || $isRead === 0 || $isRead === '0') {
                $unreadCount++;
            }
        }
        
        // Log for debugging
        \Log::info('Group unread count', [
            'group_id' => $groupIdStr,
            'user_id' => $userIdStr,
            'total_messages' => $messages->count(),
            'unread_count' => $unreadCount
        ]);
        
        return $unreadCount;
    }

    /**
     * Mark messages as read
     */
    public static function markAsRead($conversationId, $userId): void
    {
        static::where('conversation_id', $conversationId)
            ->where('to_user_id', $userId)
            ->where('is_read', false)
            ->update([
                'is_read' => true,
                'read_at' => now(),
            ]);
    }

    /**
     * Mark group messages as read for a user
     */
    public static function markGroupMessagesAsRead($groupId, $userId): void
    {
        // Convert IDs to strings for proper MongoDB comparison
        $groupIdStr = (string)$groupId;
        $userIdStr = (string)$userId;
        
        // Get all unread messages for this group
        $messages = static::where(function($q) use ($groupIdStr) {
                $q->where('group_id', $groupIdStr)
                  ->orWhere('conversation_id', 'group_' . $groupIdStr);
            })
            ->where(function($q) {
                $q->where('is_deleted', false)
                  ->orWhereNull('is_deleted');
            })
            ->where(function($q) {
                $q->where('is_read', false)
                  ->orWhereNull('is_read');
            })
            ->get();
        
        // Mark messages as read where user is NOT the sender
        foreach ($messages as $message) {
            $senderId = (string)($message->sender_id ?? $message->from_user_id ?? '');
            
            // Only mark as read if user is not the sender
            if ($senderId !== $userIdStr && $senderId !== '') {
                $message->is_read = true;
                $message->read_at = now();
                $message->save();
            }
        }
        
        \Log::info('Group messages marked as read', [
            'group_id' => $groupIdStr,
            'user_id' => $userIdStr,
            'messages_updated' => $messages->count()
        ]);
    }

    /**
     * Relationship: Sender user
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'from_user_id', '_id');
    }

    /**
     * Relationship: Receiver user
     */
    public function receiver()
    {
        return $this->belongsTo(User::class, 'to_user_id', '_id');
    }
}

