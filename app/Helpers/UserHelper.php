<?php

namespace App\Helpers;

use App\Models\Club;
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
     * @return bool
     */
    public static function isClubAdmin()
    {
        $club_member = User::query()->find(auth()->user()->id)->club_member;

        if ($club_member == null) {
            $club_member = 0;
        } else {
            $club_member = $club_member->admin;
        }

        return (int)$club_member == 1;
    }

    /**
     * @param $clubId
     * @return mixed
     */
    public static function getClubName($clubId)
    {
        $club = Club::query()->find($clubId)->first();

        return $club->name;
    }
}
