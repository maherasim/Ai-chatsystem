<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Project extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'projects';

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
    ];    
    protected $casts = [
        'start_date' => 'datetime',
        'end_date'   => 'datetime',
    ];
    
}

    

    



