<?php

namespace App\Models;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use Carbon\Carbon;
 
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
        'status',
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

    /**
     * Virtual status to allow this model to participate in status-based views.
     * If a real 'status' field exists it takes precedence; otherwise derive:
     * - in_delayed: end_date is past
     * - new: start_date is in the future
     * - in_progress: default
     */
    public function getStatusAttribute($value)
    {
        if (!empty($value)) {
            return $value;
        }
        try {
            $now = Carbon::now();
            $start = $this->start_date ? Carbon::parse($this->start_date) : null;
            $end = $this->end_date ? Carbon::parse($this->end_date) : null;
            if ($end && $end->lt($now)) {
                return 'in_delayed';
            }
            if ($start && $start->gt($now)) {
                return 'new';
            }
        } catch (\Throwable $e) {
            // fallthrough to default
        }
        return 'in_progress';
    }

    /**
     * Normalize first image as a 'mark_image_path' like field used by the view.
     */
    public function getMarkImagePathAttribute()
    {
        $images = $this->images ?? [];
        if (is_array($images) && !empty($images)) {
            return $images[0];
        }
        return null;
    }
}


