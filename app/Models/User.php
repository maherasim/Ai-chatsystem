<?php

namespace App\Models;

use Exception;
use App\Mail\SendCodeMail;
 
use Spatie\Activitylog\LogOptions;
// use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Mail;
use MongoDB\Laravel\Auth\User as Authenticatable;

use Maklad\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements MustVerifyEmail, JWTSubject
{
    use  HasFactory, Notifiable, HasRoles, CausesActivity, LogsActivity;

    protected $connection = 'mongodb';
    protected $collection = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
         
    ];

 
}
