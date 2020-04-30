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
