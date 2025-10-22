<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Project extends Model
{
    use HasFactory;

    //protected $connection = 'mongodb';
    //protected $collection = 'projects';

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
        'sections',
        'attachments',
    ];    
    protected $casts = [
        'start_date' => 'datetime',
        'end_date'   => 'datetime',
        'sections'   => 'array',
        'attachments'=> 'array',
    ];
    
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'project_id');
    }
    public function getRemainingDaysAttribute()
{
    if (!$this->end_date) {
        return null;
    }

    $end = Carbon::parse($this->end_date)->startOfDay();
    $today = Carbon::now()->startOfDay();

    $days = $today->diffInDays($end, false);

    return $days > 0 ? $days : 0;
}

}

    

    



