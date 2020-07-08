<?php

/**
 *
 * Route::namespace('Api')->name('api.')->group(base_path('routes/api/admin/base.php'));
 * Route::namespace('Setting')->group(base_path('routes/api/admin/settings.php'));
 *
 */

Route::resource('settings', 'OptionSettingController', ['except' => ['create', 'edit']]);
