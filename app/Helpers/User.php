<?php

namespace App\Helpers;

use App\Models\SuperAdmin;

class User
{
    /**
     * @return bool
     */
    public static function isSuperAdmin()
    {
        $user = SuperAdmin::query()->where('user_id', auth()->user()->id)->get();

        return $user->count() == 1;
    }
}
