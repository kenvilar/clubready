<?php

/**
 *
 * Route::namespace('Web')->name('web.')->group(base_path('routes/web/admin/base.php'));
 * Route::namespace('Membership')->name('membership.')->group(base_path('routes/web/admin/membership.php'));
 *
 */

Route::resource('memberships', 'MembershipController', ['except' => ['store', 'update', 'destroy',]]);
