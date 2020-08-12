<?php

/**
 *
 * Route::namespace('Api')->name('api.')->group(base_path('routes/api/admin/base.php'));
 * Route::namespace('Setting')->group(base_path('routes/api/admin/settings.php'));
 *
 */

Route::resource('settings', 'OptionSettingController', ['except' => ['index', 'store', 'create', 'edit',]]);
Route::delete('settings/{setting}/removeFavicon', 'OptionSettingController@removeFavicon')->name('settings.removeFavicon');
Route::put('settings/{user}/changePassword', 'ChangePasswordController@update')->name('settings.changePassword');
