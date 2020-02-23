<?php

/**
 *
 * Route::namespace('Api')->name('api.')->group(base_path('routes/api/admin/base.php'));
 * Route::namespace('MembershipType')->name('membership-type.')->group(base_path('routes/api/admin/membership-type.php'));
 *
 */

Route::resource('membership-types', 'MembershipTypeController', ['except' => ['create', 'edit']]);
