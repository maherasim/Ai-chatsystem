<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Task extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'tasks';

    protected $fillable = [
        'project_id',
        'ticket_id',
        'title',
        'description',
        'status',
        'start_date',
        'end_date',
        'checkpoints', // array of strings
        'shape',
        'color',
        'position', // { left, top }
        'number',
        'mark_image_path', // saved file path in storage
        'issues', // array of embedded issue objects
        'created_by',
        'hold_reason', // reason for putting task on hold
    ];

    protected $casts = [
        'start_date'  => 'datetime',
        'end_date'    => 'datetime',
        'checkpoints' => 'array',
        'position'    => 'array',
        'issues'      => 'array',
        
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }
}


