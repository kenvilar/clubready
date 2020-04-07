<?php

namespace App\Http\Controllers\Web\Passport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PassportController extends Controller
{
    public function passportClients()
    {
        return view('admin.passport.passport-clients');
    }

    public function passportAuthorizedClients()
    {
        return view('admin.passport.passport-authorized-clients');
    }

    public function passportPersonalAccessTokens()
    {
        return view('admin.passport.passport-personal-access-tokens');
    }
}
