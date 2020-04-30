<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($club) {
            $club->uuid = (string)Str::uuid();
        });
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function clubMembers()
    {
        return $this->hasMany(ClubMember::class);
    }
}
