<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $fillable = [
        'year',
        'name',
        'amount',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
