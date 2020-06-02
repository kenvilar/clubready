<?php

/**
 *
 * Route::namespace('Api')->name('api.')->group(base_path('routes/api/admin/base.php'));
 * Route::namespace('User')->name('user.')->group(base_path('routes/api/admin/user.php'));
 *
 */

use Illuminate\Http\Request;

Route::post('logoutapi', function (Request $request) {
    // Delete the personal access token session and token field in users table
    session()->forget('myToken');
    session()->forget('my_app__current_member');

    // Revoke the token in passport table
    $request->user()->token()->revoke();
})->middleware('auth:api')->name('logoutapi');
Route::resource('users', 'UserController', ['except' => ['create', 'edit']]);
