<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Setting extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'settings';

    protected $fillable = [
        'image',
        'first_name',
        'dob',
        'login_backgrounds',
        'chat_backgrounds',
        'user_id',
        'chat_sounds',
        'notification_sounds',        
        'app_logo',
        'policy_html',
        'policy_version',
        'agreement_html',
        'agreement_version',
        'require_accept_on_next_login',
        'screen_lock',
        'screen_lock_minutes',
    ];

    

    
}
