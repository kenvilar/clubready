<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class ClubMember extends Model
{
    const ADMIN_USER = '1';
    const NON_ADMIN_USER = '0';

    protected $fillable = [
        'user_id',
        'club_id',
        'admin',
        'uuid',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($clubMember) {
            $clubMember->uuid = (User::query()->find($clubMember->user_id))->member_number . '-' . $clubMember->club_id;
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

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function club()
    {
        return $this->belongsTo(Club::class);
    }

    /**
     * @return HasMany
     */
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

    /**
     * @return HasMany
     */
    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }

    /**
     * @return HasMany
     */
    public function membershipTypes()
    {
        return $this->hasMany(MembershipType::class);
    }

    /**
     * @return HasMany
     */
    public function membershipTypeNames()
    {
        return $this->hasMany(MembershipTypeName::class);
    }
}
