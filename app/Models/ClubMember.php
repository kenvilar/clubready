<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClubMember extends Model
{
    const ADMIN_USER = '1';
    const NON_ADMIN_USER = '0';

    protected $fillable = [
        'user_id',
        'club_id',
        'vehicle_id',
        'admin',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function clubs()
    {
        return $this->belongsTo(Club::class);
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
