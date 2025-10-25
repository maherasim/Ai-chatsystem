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
        'title',
        'department',
        'email',
        'user_description',
        'password',
        'gender',
        'type',
        'image',
        'banner',
        'permissions',
        'active',
        'dob',
        'screen_lock',
        'screen_lock_minutes',
        'two_factor_auth', 
        'user_id',
    ];

    public function attachments()
    {
        return $this->hasMany(UserAttachment::class, 'user_id', '_id');
    }

 
}
