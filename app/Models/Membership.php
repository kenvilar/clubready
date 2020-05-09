<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $fillable = [
        'club_member_id',
        'club_id',
        'year',
        'name',
        'amount',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function clubMembers()
    {
        return $this->belongsTo(ClubMember::class);
    }
}
