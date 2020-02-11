<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'make',
        'model',
        'year',
        'capacity',
        'induction',
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
