<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class WebTask extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'web_tasks';

    protected $fillable = [
        'project_id',
        'ticket_id',
        'title',
        'description',
        'start_date',
        'end_date',
        'checkpoints',
        'shape',
        'status',
        'color',
        'position',
        'number',
        'mark_image_path',
        'board_image_path',
        'issues',
        'video_link', // video link for checking tasks
        'attachments', // file attachments array
        'rejections', // array of rejection history
        'created_by',
    ];

    protected $casts = [
        'start_date'  => 'datetime',
        'end_date'    => 'datetime',
        'checkpoints' => 'array',
        'position'    => 'array',
        'issues'      => 'array',
        'attachments' => 'array',
        'rejections'  => 'array',
    ];
}


