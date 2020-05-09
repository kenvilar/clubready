<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipTypeName extends Model
{
    protected $fillable = [
        'club_member_id',
        'club_id',
        'name',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
