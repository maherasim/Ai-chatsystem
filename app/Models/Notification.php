<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Notification extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'notifications';

    protected $fillable = [
        'user_id',
        'type',
        'title',
        'message',
        'data',
        'read',
        'created_by',
        'task_id',
    ];

    protected $casts = [
        'read' => 'boolean',
        'data' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the notification
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', '_id');
    }

    /**
     * Get the user who created the notification
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', '_id');
    }
}

