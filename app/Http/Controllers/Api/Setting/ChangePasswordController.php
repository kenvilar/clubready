<?php

namespace App\Http\Controllers\Api\Setting;

use App\Http\Controllers\ApiController;
use App\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ChangePasswordController extends ApiController
{
    use ResetsPasswords;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return void
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, User $user)
    {
        if (Hash::check($request->current_password, $user->password)) {
            $this->setUserPassword($user, $request->password1);

            $user->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));

            return $this->showOne($user);
        } else {
            return $this->errorResponse('Passwords do not match', 409);
        }
    }
}
