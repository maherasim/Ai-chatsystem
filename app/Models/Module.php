<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'modules';

    protected $fillable = [
        'name', 
    ];
}
