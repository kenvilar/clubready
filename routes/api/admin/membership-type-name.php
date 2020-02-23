<?php

/**
 *
 * Route::namespace('Api')->name('api.')->group(base_path('routes/api/admin/base.php'));
 * Route::namespace('MembershipTypeName')->name('membership-type-name.')->group(base_path('routes/api/admin/membership-type-name.php'));
 *
 */

Route::resource('membership-type-names', 'MembershipTypeNameController', ['except' => ['create', 'edit']]);
