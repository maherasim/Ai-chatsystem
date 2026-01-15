<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Favorite extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'favorites';

    protected $fillable = [
        'user_id',
        'message_id',
        'group_id',
        'media_type', // 'photo', 'video', 'document', 'link', 'audio'
        'file_url',
        'file_name',
        'url', // For links
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Check if a media item is favorited by a user
     */
    public static function isFavorited($userId, $messageId)
    {
        return self::where('user_id', $userId)
            ->where('message_id', $messageId)
            ->exists();
    }

    /**
     * Get all favorites for a user
     */
    public static function getUserFavorites($userId, $groupId = null)
    {
        $query = self::where('user_id', $userId);
        if ($groupId) {
            $query->where('group_id', $groupId);
        }
        return $query->get();
    }
}
