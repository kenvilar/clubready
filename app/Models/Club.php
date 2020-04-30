<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    protected $fillable = [
        'name',
        'address',
        'suburb',
        'state',
        'postcode',
        'country',
        'phone',
        'email',
        'website',
        'stripe_keys',
        'uuid',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function clubMembers()
    {
        return $this->hasMany(ClubMember::class);
    }
}
