<?php

/**
 *
 * Route::namespace('Web')->name('web.')->group(base_path('routes/web/admin/base.php'));
 * Route::namespace('SuperAdmin')->name('super-admin.')->group(base_path('routes/web/admin/super-admin.php'));
 *
 */

Route::resource('super-admins', 'SuperAdminController', ['except' => ['store', 'update', 'destroy',]]);
