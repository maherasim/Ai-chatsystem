<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'tickets';

    protected $fillable = [
        'code',              // human-friendly ticket code like TK-1001
        'project_id',        // reference to Project _id
        'project_title',     // denormalized for quick display
        'section_name',      // section within project
        'title',
        'description',
        'status',            // in_progress, in_hold, delayed, completed
        'priority',          // low, medium, high
        'start_date',
        'end_date',
        'reminder_hours',
        'created_by',        // user id
        'assignees',         // array of user ids (optional)
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date'   => 'datetime',
        'assignees'  => 'array',
    ];
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}



