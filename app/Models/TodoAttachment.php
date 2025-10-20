<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TodoAttachment extends Model
{


    protected $collection = 'todo_attachments';
    protected $fillable = [
        'todo_id',
        'file_name',
        'file_path',
        'file_type',
        'uploaded_by',
        'size'
    ];

    public function todo()
    {
        return $this->belongsTo(Todo::class, 'todo_id');
    }
}
