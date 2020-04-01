<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class MembershipType extends Model
{
    protected $fillable = [
        'name',
        'value',
        'start_date',
        'expiry_date',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function clubMembers()
    {
        return $this->belongsTo(ClubMember::class);
    }

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = Carbon::createFromFormat('m/d/Y', $value)->format('Y-m-d');
    }

    public function getStartDateAttribute($value)
    {
        return Carbon::parse($value)->format('m/d/Y');
    }

    public function setExpiryDateAttribute($value)
    {
        $this->attributes['expiry_date'] = Carbon::createFromFormat('m/d/Y', $value)->format('Y-m-d');
    }

    public function getExpiryDateAttribute($value)
    {
        return Carbon::parse($value)->format('m/d/Y');
    }
}
