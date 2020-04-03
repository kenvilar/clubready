<?php

/**
 *
 * Route::namespace('Api')->name('api.')->group(base_path('routes/api/admin/base.php'));
 * Route::namespace('User')->name('user.')->group(base_path('routes/api/admin/user.php'));
 *
 */

Route::resource('users', 'UserController', ['except' => ['create', 'edit']]);
