<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Keyword extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'keywords';

    protected $fillable = [
        'name',
        'language',
    ];
}

