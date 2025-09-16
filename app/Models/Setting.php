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
        'policy_term',
        'agreement_text',
        'increment_version',
        'require_accept',
        'agreement_term',
        'agreement_version',
        'agreement_require_accept',
        'notification_sounds',        
        'app_logo',
        'policy_html',
        'policy_version',
        'agreement_html',
        'agreement_version',
        'agreement_require_accept',
        
    ];

    

    
}
