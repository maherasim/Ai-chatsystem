<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'chat_messages';

    protected $fillable = [
        'message_id',
        'from_user_id',
        'sender_id',
        'to_user_id',
        'group_id',
        'conversation_id',
        'message_type',
        'content',
        'file_url',
        'file_name',
        'file_size',
        'thumbnail_url',
        'reply_to_message_id',
        'replied_to_message_id',
        'is_forwarded',
        'is_deleted',
        'is_read',
        'read_at',
        'reactions',
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
     * Relationship: Sender user
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id', '_id')
            ->orWhere('from_user_id', $this->sender_id ?? $this->from_user_id);
    }

    /**
     * Relationship: Receiver user
     */
    public function receiver()
    {
        return $this->belongsTo(User::class, 'to_user_id', '_id');
    }

    /**
     * Relationship: Group
     */
    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id', '_id');
    }

    /**
     * Generate conversation ID for two users
     */
    public static function generateConversationId($userId1, $userId2)
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
        $query = self::where('conversation_id', $conversationId)
            ->orderBy('created_at', 'desc')
            ->limit($limit);

        if ($beforeMessageId) {
            $query->where('_id', '<', $beforeMessageId);
        }

        return $query->get()->reverse();
    }

    /**
     * Mark messages as read
     */
    public static function markAsRead($conversationId, $userId)
    {
        return self::where('conversation_id', $conversationId)
            ->where('to_user_id', $userId)
            ->where('is_read', false)
            ->update([
                'is_read' => true,
                'read_at' => now(),
            ]);
    }
}

