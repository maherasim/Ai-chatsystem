<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserAttachment extends Model
{


    protected $collection = 'user_attachments';
    protected $fillable = [
        'user_id',
        'file_name',
        'file_path',
        'file_type',
        'uploaded_by',
        'size'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', '_id');
    }
}
