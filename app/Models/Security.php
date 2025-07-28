<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Security extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'security';

    protected $fillable = [
        'image',
        'first_name',
        'dob',
        'user_id'
    ];

    

    
}
