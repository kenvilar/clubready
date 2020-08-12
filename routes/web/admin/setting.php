<?php

/**
 *
 * Route::namespace('Web')->name('web.')->group(base_path('routes/web/admin/base.php'));
 * Route::namespace('Setting')->name('setting.')->group(base_path('routes/web/admin/setting.php'));
 *
 */

Route::resource('settings', 'OptionSettingController',
    ['except' => ['create', 'show', 'store', 'edit', 'update', 'destroy',]])
    ->names([
        'index' => 'index',
    ]);
Route::get('settings/change-password', 'ChangePasswordController@edit')->name('changePassword');
