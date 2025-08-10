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
 

class Project extends Authenticatable implements MustVerifyEmail
{
    use  HasFactory, Notifiable;

    protected $connection = 'mongodb';
    protected $collection = 'projects';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
   protected $fillable = [
    'title',             // Project Title (string)
    'priority',          // Project Priority (string)
    'date_time',         // Start and End Date (string or date)
    'description',       // Description (string or rich text)
    'sections',          // Sections (array)
    'project_managers',  // Project Managers (array of IDs or strings)
    'developers',        // Developers (array of IDs or strings)
    'image',             // Single image upload (file path or URL)
    'upload_files',      // Multiple uploaded files (file paths or URLs)
];


 
}
