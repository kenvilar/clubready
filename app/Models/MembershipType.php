<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipType extends Model
{
    protected $fillable = [
        'name',
        'value',
        'start_date',
        'expiry_date',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
