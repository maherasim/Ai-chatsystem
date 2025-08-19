<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Payment extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'payments';

    protected $fillable = [
        'post_job_id',
        'payer_user_id',
        'payee_provider_id',
        'amount',
        'commission_percent',
        'commission_amount',
        'net_amount',
        'method',
        'meta',
    ];

    protected $casts = [
        'amount' => 'float',
        'commission_percent' => 'float',
        'commission_amount' => 'float',
        'net_amount' => 'float',
        'meta' => 'array',
    ];
}

