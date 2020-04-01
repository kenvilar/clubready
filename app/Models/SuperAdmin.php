<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuperAdmin extends Model
{
    protected $fillable = [
        'user_id',
        'created_at',
    ];

    protected $hidden = [
        'updated_at',
    ];
}
