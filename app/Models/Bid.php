<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Bid extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'bids';

    protected $fillable = [
        'post_job_id',
        'provider_id',
        'amount',
        'status',
    ];

    protected $casts = [
        'amount' => 'float',
    ];

    public const STATUS_PENDING = 'pending';
    public const STATUS_ACCEPTED = 'accepted';
    public const STATUS_REJECTED = 'rejected';

    public function postJob()
    {
        return $this->belongsTo(PostJob::class, 'post_job_id');
    }

    public function provider()
    {
        return $this->belongsTo(User::class, 'provider_id');
    }
}

