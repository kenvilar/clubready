<?php

/**
 *
 * Route::namespace('Web')->name('web.')->group(base_path('routes/web/admin/base.php'));
 * Route::namespace('ClubMember')->name('club-member.')->group(base_path('routes/web/admin/club-member.php'));
 *
 */

Route::resource('club-members', 'ClubMemberController', ['except' => ['store', 'update', 'destroy',]])
    ->names([
        'index' => 'index',
        'create' => 'create',
        'show' => 'show',
        'edit' => 'edit',
    ]);

Route::group(['as' => 'members.'], function () {
    Route::resource('club-members.members', 'ClubMemberClubMemberController',
        ['except' => ['store', 'update', 'destroy',]])
        ->names([
            'index' => 'index',
            'create' => 'create',
            'show' => 'show',
            'edit' => 'edit',
        ]);
});

Route::group(['as' => 'memberships.'], function () {
    Route::resource('club-members.memberships', 'ClubMemberMembershipController',
        ['except' => ['store', 'update', 'destroy',]])
        ->names([
            'index' => 'index',
            'create' => 'create',
            'show' => 'show',
            'edit' => 'edit',
        ]);
});

Route::group(['as' => 'membership-types.'], function () {
    Route::resource('club-members.membership-types', 'ClubMemberMembershipTypeController',
        ['except' => ['store', 'update', 'destroy',]])
        ->names([
            'index' => 'index',
            'create' => 'create',
            'show' => 'show',
            'edit' => 'edit',
        ]);
});

Route::group(['as' => 'membership-type-names.'], function () {
    Route::resource('club-members.membership-type-names', 'ClubMemberMembershipTypeNameController',
        ['except' => ['store', 'update', 'destroy',]])
        ->names([
            'index' => 'index',
            'create' => 'create',
            'show' => 'show',
            'edit' => 'edit',
        ]);
});

Route::group(['as' => 'vehicles.'], function () {
    Route::resource('club-members.vehicles', 'ClubMemberVehicleController',
        ['except' => ['store', 'update', 'destroy',]])
        ->names([
            'index' => 'index',
            'create' => 'create',
            'show' => 'show',
            'edit' => 'edit',
        ]);
});
