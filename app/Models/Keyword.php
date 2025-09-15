<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Keyword extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'keywords';

    protected $fillable = [
        'letter',
        'word'
    ];
    protected $hidden = [
        // any fields to hide from API
    ];

    
}
