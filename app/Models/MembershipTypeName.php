<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MembershipTypeName extends Model
{
    protected $fillable = [
        'club_member_id',
        'name',
        'created_at',
    ];

    protected $hidden = [
        'updated_at',
    ];

    /**
     * @return BelongsTo
     */
    public function club_member()
    {
        return $this->belongsTo(ClubMember::class);
    }
}
