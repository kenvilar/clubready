<?php

namespace App;

use App\Models\ClubMember;
use App\Models\SuperAdmin;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    const VERIFIED_USER = '1';
    const UNVERIFIED_USER = '0';

    const ADMIN_USER = '1';
    const NON_ADMIN_USER = '0';

    const ACTIVE_USER = '1';
    const INACTIVE_USER = '0';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'address',
        'suburb',
        'state',
        'postcode',
        'country',
        'phone_home',
        'phone_mobile',
        'alternative_email',
        'date_of_birth',
        'member_number',
        'club_racenumber',
        'verified',
        'verification_token',
        'admin',
        'active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'verification_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->member_number = (string)Str::uuid();
        });
    }

    public function isVerified()
    {
        return $this->verified == User::VERIFIED_USER;
    }

    public function isAdmin()
    {
        return $this->admin == User::ADMIN_USER;
    }

    public static function generateVerificationCode()
    {
        return Str::random(40);
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'member_number';
    }

    /**
     * @param $value
     */
    public function setDateOfBirthAttribute($value)
    {
        $value = $value ? Carbon::createFromFormat('m/d/Y', $value)->format('Y-m-d') : null;
        $this->attributes['date_of_birth'] = $value;
    }

    /**
     * @param $value
     * @return string|null
     */
    public function getDateOfBirthAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('m/d/Y') : null;
    }

    /**
     * Validate the password of the user for the Passport password grant.
     *
     * @param string $password
     * @return bool
     */
    public function validateForPassportPasswordGrant($password)
    {
        return Hash::check($password, $this->password);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function club_member()
    {
        return $this->hasOne(ClubMember::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function super_admin()
    {
        return $this->hasOne(SuperAdmin::class);
    }
}
