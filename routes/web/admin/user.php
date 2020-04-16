<?php

/**
 *
 * Route::namespace('Web')->name('web.')->group(base_path('routes/web/admin/base.php'));
 * Route::namespace('User')->name('user.')->group(base_path('routes/web/admin/user.php'));
 *
 */

Route::get('users/user-token', 'UserController@userToken');

Route::resource('users', 'UserController', ['except' => ['store', 'update', 'destroy',]])->names([
    'index' => 'index',
    'create' => 'create',
    'show' => 'show',
    'edit' => 'edit',
]);
