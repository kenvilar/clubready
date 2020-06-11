<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vehicle extends Model
{
    protected $fillable = [
        'club_member_id',
        'make',
        'model',
        'year',
        'capacity',
        'induction',
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

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
