<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

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
        'start_date' => 'date',
        'end_date' => 'date',
    ];
}

