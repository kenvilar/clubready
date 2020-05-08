<?php

namespace App\Http\Controllers\Web\Passport;

use App\Http\Controllers\Controller;

class PassportController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('super-admin');
    }

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
