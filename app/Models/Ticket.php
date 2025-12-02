<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Ticket extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'tickets';

    protected $fillable = [
        'code',
        'project_id',
        'project_title',
        'section_name',
        'title',
        'description',
        'status',
        'priority',
        'start_date',
        'end_date',
        'reminder_hours',
        'created_by',
        'assignees',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'reminder_hours' => 'integer',
        'assignees' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the project that owns the ticket
     */
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    /**
     * Get the user who created the ticket
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
