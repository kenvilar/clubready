<?php

/**
 *
 * Route::namespace('Api')->name('api.')->group(base_path('routes/api/admin/base.php'));
 * Route::namespace('User')->name('user.')->group(base_path('routes/api/admin/user.php'));
 *
 */

Route::group(['middleware' => ['web']], function () {
    Route::get('users/my-info', 'UserController@currentUserInfo')->name('current-user-info');
});

Route::resource('users', 'UserController', ['except' => ['create', 'edit']]);
