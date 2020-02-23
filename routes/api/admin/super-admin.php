<?php

/**
 *
 * Route::namespace('Api')->name('api.')->group(base_path('routes/api/admin/base.php'));
 * Route::namespace('SuperAdmin')->name('super-admin.')->group(base_path('routes/api/admin/super-admin.php'));
 *
 */

Route::resource('super-admins', 'SuperAdminController', ['except' => ['create', 'edit']]);
