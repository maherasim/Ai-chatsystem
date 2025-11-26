<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use Carbon\Carbon;

class Project extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'projects';

    protected $fillable = [
        'title',
        'code',
        'status',
        'priority',
        'start_date',
        'end_date',
        'description',
        'reminder_days',
        'progress_percent',
        'logo_path',
        'user_id',

        // Arrays (full arrays, NOT nested keys)
        'phases',
        'sections',
        'attachments',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date'   => 'datetime',

        // Cast arrays correctly
        'sections'   => 'array',
        'phases'     => 'array',
        'attachments'=> 'array',
    ];

    // Relations
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'project_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'project_id');
    }

    // Virtual attribute: remaining days
    public function getRemainingDaysAttribute()
    {
        if (!$this->end_date) {
            return null;
        }

        $end = Carbon::parse($this->end_date)->startOfDay();
        $today = now()->startOfDay();

        $days = $today->diffInDays($end, false);

        return $days > 0 ? $days : 0;
    }
}
