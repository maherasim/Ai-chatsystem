<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class EmployeeTask extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'employee_tasks';

    protected $fillable = [
        'project_id',
        'ticket_id',
        'title',
        'description',
        'status',
        'start_date',
        'end_date',
        'checkpoints',
        'shape',
        'color',
        'position',
        'number',
        'mark_image_path',
        'issues',
        'created_by',
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
