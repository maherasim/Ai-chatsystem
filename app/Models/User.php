<?php

namespace App\Models;

use Exception;
use App\Mail\SendCodeMail;
 
 
// use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
 
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Mail;
use MongoDB\Laravel\Auth\User as Authenticatable;

 
use Illuminate\Support\Facades\Auth;
 

class User extends Authenticatable implements MustVerifyEmail
{
    use  HasFactory, Notifiable;

    protected $connection = 'mongodb';
    protected $collection = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'user_id',
        'department',
        'email',
        'password',
        'phone',
        'image',
        'profile_image',
        'permissions',
        'active',
        'dob',
        'screen_lock',
        'two_factor_auth', 
        'policy_accepted',
        'agreement_accepted',
        'country',
        'card_image',
        'description',
        'group_read_timestamps',
        'last_activity',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'last_activity' => 'datetime',
        'active' => 'boolean',
        'policy_accepted' => 'boolean',
        'agreement_accepted' => 'boolean',
    ];
}
