<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Todo extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'todo';

    protected $fillable = [
        'title',
        'user_id',
        'description',
        'is_schduled',
        'start_date',
        'start_time',
        'end_date',
        'end_time',
        'is_private',
        'project',        
        'priority',
        'reminder',
        'completed',
        'members',
        'is_removed',
        'reason',
        'total_time',
        'ratings',
        'reliability',
        'punctuality',
        'accuracy',
        'quality',
        'work_Independently'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', '_id');
    }

    public function assignedUsers()
    {
        return $this->belongsToMany(User::class, null, 'todo_ids', 'user_ids');
    }
    public function attachments()
    {
        return $this->hasMany(TodoAttachment::class, 'todo_id');
    }
    
}
