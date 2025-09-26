<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

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
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'progress_percent' => 'integer',
        'reminder_days' => 'integer',
    ];
}

