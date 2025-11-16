<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use MongoDB\BSON\ObjectId;

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
        'team',     
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
        'files_upload',
        'link_type',
        'meet_link'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', '_id');
    }

    public function members()
{
    return $this->hasMany(MeetingMembers::class, 'meeting_id', '_id');
}

public function getMembersDataAttribute()
{
    return $this->members->map(function ($member) {
        return [
            'id' => (string) $member->user->_id,
            'name' => $member->user->name ?? '',
            'email' => $member->user->email ?? '',
            'image' => $member->user->image
                ? asset($member->user->image)
                : asset('build/img/profile.svg'),
            'decision' => $member->decision,
        ];
    })->toArray();
}

}
