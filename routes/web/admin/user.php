<?php

/**
 *
 * Route::namespace('Web')->name('web.')->group(base_path('routes/web/admin/base.php'));
 * Route::namespace('User')->name('user.')->group(base_path('routes/web/admin/user.php'));
 *
 */

Route::get('users', 'UserController@index')->name('index');
Route::get('users/create', 'UserController@create')->name('create');
Route::get('users/{user}', 'UserController@show')->name('show');
Route::get('users/{user}/edit', 'UserController@edit')->name('edit');

