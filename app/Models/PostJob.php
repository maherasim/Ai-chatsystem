<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class PostJob extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'post_jobs';

    protected $fillable = [
        'title',
        'description',
        'created_by_user_id',
        'status',
        'accepted_bid_id',
        'assigned_provider_id',
        'events',
        'total_amount',
        'extra_charges',
        'advance_paid_amount',
    ];

    protected $casts = [
        'events' => 'array',
        'total_amount' => 'float',
        'extra_charges' => 'float',
        'advance_paid_amount' => 'float',
    ];

    public const STATUS_OPEN = 'open';
    public const STATUS_ACCEPTED = 'accepted';
    public const STATUS_PROVIDER_STARTED = 'provider_started';
    public const STATUS_READY_TO_START = 'ready_to_start';
    public const STATUS_IN_PROGRESS = 'in_progress';
    public const STATUS_ON_HOLD = 'on_hold';
    public const STATUS_DONE_BY_PROVIDER = 'done_by_provider';
    public const STATUS_CONFIRMED_BY_USER = 'confirmed_by_user';
    public const STATUS_COMPLETED = 'completed';

    public function bids()
    {
        return $this->hasMany(Bid::class, 'post_job_id');
    }

    public function acceptedBid()
    {
        return $this->belongsTo(Bid::class, 'accepted_bid_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }
}

