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
        'start_date',
        'end_date',
        'checkpoints', // array of strings
        'shape',
        'color',
        'position', // { left, top }
        'number',
        'mark_image_path', // saved file path in storage
        'created_by',
    ];

    protected $casts = [
        'start_date'  => 'datetime',
        'end_date'    => 'datetime',
        'checkpoints' => 'array',
        'position'    => 'array',
    ];
}


