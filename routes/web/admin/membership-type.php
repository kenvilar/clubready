<?php

/**
 *
 * Route::namespace('Web')->name('web.')->group(base_path('routes/web/admin/base.php'));
 * Route::namespace('MembershipType')->name('membership-type.')->group(base_path('routes/web/admin/membership-type.php'));
 *
 */

Route::resource('membership-types', 'MembershipTypeController', ['except' => ['store', 'update', 'destroy',]]);
