<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agreementmodel extends Model
{
    protected $fillable = [
        'agreement_text',
        'agreement_require_accept',
        'agreement_version',
    ];
}
