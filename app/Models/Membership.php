<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $fillable = [
        'club_member_id',
        'year',
        'name',
        'amount',
        'created_at',
    ];

    protected $hidden = [
        'updated_at',
    ];

    public function club_member()
    {
        return $this->belongsTo(ClubMember::class);
    }
}
