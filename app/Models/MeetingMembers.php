<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class MeetingMembers extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'meeting_members';

    protected $fillable = [
        'meeting_id',
        'user_id',
        'decision', // 0=pending, 1=accepted, 2=rejected
    ];

    public function meeting()
    {
        return $this->belongsTo(Meetings::class, 'meeting_id', '_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', '_id');
    }
}
