<?php

/**
 *
 * Route::namespace('Api')->name('api.')->group(base_path('routes/api/admin/base.php'));
 * Route::namespace('ClubMember')->name('club-member.')->group(base_path('routes/api/admin/club-member.php'));
 *
 */

Route::resource('club-members', 'ClubMemberController', ['except' => ['create', 'edit']]);

Route::resource('club-members.members', 'ClubMemberClubMemberController', ['except' => ['create', 'edit']]);

Route::resource('club-members.memberships', 'ClubMemberMembershipController', ['except' => ['create', 'edit']]);

Route::resource('club-members.membership-types', 'ClubMemberMembershipTypeController', ['except' => ['create', 'edit']]);

Route::resource('club-members.membership-type-names', 'ClubMemberMembershipTypeNameController', ['except' => ['create', 'edit']]);

Route::resource('club-members.vehicles', 'ClubMemberVehicleController', ['except' => ['create', 'edit']]);
