<?php

namespace App\Helpers;

use App\Models\SuperAdmin;
use App\User;

class UserHelper
{
    /**
     * Returns true if the current authenticated user is a super admin
     *
     * @return bool
     */
    public static function isSuperAdmin()
    {
        $user = SuperAdmin::query()->where('user_id', auth()->user()->id)->get();

        return $user->count() == 1;
    }

    /**
     * Returns true if the current authenticated user is a club admin
     *
     * @return mixed
     */
    public static function isClubAdmin()
    {
        $club_member = User::query()->find(auth()->user()->id)->club_member();

        return $club_member->count();
    }
}
