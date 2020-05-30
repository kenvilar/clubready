<?php

/**
 *
 * Route::namespace('Api')->name('api.')->group(base_path('routes/api/admin/base.php'));
 * Route::namespace('ClubMember')->name('club-member.')->group(base_path('routes/api/admin/club-member.php'));
 *
 */

Route::resource('club-members', 'ClubMemberController', ['except' => ['create', 'edit']]);

Route::resource('club-members.memberships', 'ClubMemberMembershipController', ['except' => ['create', 'edit']]);

Route::resource('club-members.vehicles', 'ClubMemberVehicleController', ['except' => ['create', 'edit']]);
