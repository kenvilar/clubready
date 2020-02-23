<?php

/**
 *
 * Route::namespace('Api')->name('api.')->group(base_path('routes/api/admin/base.php'));
 * Route::namespace('Membership')->name('membership.')->group(base_path('routes/api/admin/membership.php'));
 *
 */

Route::resource('memberships', 'MembershipController', ['except' => ['create', 'edit']]);
