<?php

/**
 *
 * Route::namespace('Web')->name('web.')->group(base_path('routes/web/admin/base.php'));
 * Route::namespace('MembershipTypeName')->name('membership-type-name.')->group(base_path('routes/web/admin/membership-type-name.php'));
 *
 */

Route::resource('membership-type-names', 'MembershipTypeNameController', ['except' => ['store', 'update', 'destroy',]]);
