<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'teams';

    protected $fillable = [
        'title',
        'project_id',
        'pm_id',
        'timeline_color',
        'banner_path',
        'thumb_path',
        'tickets',
        'tasks',
        'task_priorities',
        'task_developers',
        'user_id',
    ];

    protected $casts = [
        'tickets' => 'array',
        'tasks' => 'array',
        'task_priorities' => 'array',
        'task_developers' => 'array',
    ];
}


