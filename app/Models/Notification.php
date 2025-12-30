<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Notification extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'notifications';

    protected $fillable = [
        'user_id',          // User who receives the notification
        'type',             // 'task_assigned', 'task_started', etc.
        'title',            // Notification title
        'message',          // Notification message
        'task_id',          // Related task ID (if applicable)
        'read',             // Boolean: whether notification is read
        'created_by',       // User who triggered the notification
    ];

    protected $casts = [
        'read' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', '_id');
    }

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id', '_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', '_id');
    }
}

