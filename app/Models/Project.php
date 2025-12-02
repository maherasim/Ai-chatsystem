<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Project extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'projects';

    protected $fillable = [
        'title',
        'description',
        'logo_path',
        'sections',
        'status',
        'start_date',
        'end_date',
        'created_by',
        'team_members',
    ];

    protected $casts = [
        'sections' => 'array',
        'team_members' => 'array',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the tickets for the project
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'project_id');
    }

    /**
     * Get the user who created the project
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
