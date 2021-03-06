<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'site_name',
        'logo',
        'favicon',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
