<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'user_id',
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

    public function clubMembers()
    {
        return $this->belongsTo(ClubMember::class);
    }
}
