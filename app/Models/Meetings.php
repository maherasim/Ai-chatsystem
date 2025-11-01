<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Meetings extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'meetings';

    protected $fillable = [
        'title',
        'user_id',
        'description',
        'is_schduled',
        'start_date',
        'start_time',
        'end_date',
        'end_time',
        'is_private',
        'project',        
        'priority',
        'reminder',
        'completed',
        'members',
        'is_removed',
        'reason',
        'total_time',
        'ratings',
        'reliability',
        'punctuality',
        'accuracy',
        'quality',
        'work_Independently',
        'all_tasks_done',
        'all_tasks_check',
        'files_upload'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', '_id');
    }

    
}
