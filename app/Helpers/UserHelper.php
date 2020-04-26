<?php

namespace App\Helpers;

use App\Models\SuperAdmin;

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
}
