<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class MembershipType extends Model
{
    protected $fillable = [
        'club_member_id',
        'name',
        'value',
        'start_date',
        'expiry_date',
        'created_at',
    ];

    protected $hidden = [
        'updated_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function club_member()
    {
        return $this->belongsTo(ClubMember::class);
    }

    /**
     * @param $value
     */
    public function setStartDateAttribute($value)
    {
        $value = $value ? Carbon::createFromFormat('m/d/Y', $value)->format('Y-m-d') : null;
        $this->attributes['start_date'] = $value;
    }

    /**
     * @param $value
     * @return string|null
     */
    public function getStartDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('m/d/Y') : null;
    }

    /**
     * @param $value
     */
    public function setExpiryDateAttribute($value)
    {
        $value = $value ? Carbon::createFromFormat('m/d/Y', $value)->format('Y-m-d') : null;
        $this->attributes['expiry_date'] = $value;
    }

    /**
     * @param $value
     * @return string|null
     */
    public function getExpiryDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('m/d/Y') : null;
    }
}
