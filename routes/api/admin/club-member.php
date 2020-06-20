<?php

/**
 *
 * Route::namespace('Api')->name('api.')->group(base_path('routes/api/admin/base.php'));
 * Route::namespace('ClubMember')->name('club-member.')->group(base_path('routes/api/admin/club-member.php'));
 *
 */

Route::resource('club-members', 'ClubMemberController', ['except' => ['create', 'edit']]);

Route::delete('club-members/{club_member}/unverified-user/{member}', 'ClubMemberClubMemberController@unverifiedUser');

Route::resource('club-members.clubs', 'ClubMemberClubController', ['except' => ['store', 'create', 'edit', 'show', 'destroy',]]);

Route::resource('club-members.members', 'ClubMemberClubMemberController', ['except' => ['create', 'edit', 'unverifiedUser',]]);

Route::resource('club-members.memberships', 'ClubMemberMembershipController', ['except' => ['create', 'edit']]);

Route::resource('club-members.membership-types', 'ClubMemberMembershipTypeController', ['except' => ['create', 'edit']]);

Route::resource('club-members.membership-type-names', 'ClubMemberMembershipTypeNameController', ['except' => ['create', 'edit']]);

Route::resource('club-members.vehicles', 'ClubMemberVehicleController', ['except' => ['create', 'edit']]);
