<?php

namespace App\Models;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
 
class EmployeeTask extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'employee_tasks';
    protected $fillable = [
        'project_id',
        'ticket_id',
        'title',
        'priority',
        'description',
        'start_date',
        'end_date',
        'day',
        'duration',
        'reminder_hours',
        'images',
        'created_by',
    ];

    protected $casts = [
        'images' => 'array',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
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


