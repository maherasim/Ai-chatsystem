<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class UserModule extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'user_modules';

    protected $fillable = [
        'user_id',
        'module_id',
        'enabled',
        'read',
        'write',
        'delete',
    ];

    protected $casts = [
        'enabled' => 'boolean',
        'read'    => 'boolean',
        'write'   => 'boolean',
        'delete'  => 'boolean',
    ];

   
    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
