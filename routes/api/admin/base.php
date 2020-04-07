<?php

/**
 *
 * Route::namespace('Api')->name('api.')->group(base_path('routes/api/admin/base.php'));
 *
 */

/**
 * Club
 */
Route::namespace('Club')->name('club.')->group(base_path('routes/api/admin/club.php'));

/**
 * ClubMember
 */
Route::namespace('ClubMember')->name('club-member.')->group(base_path('routes/api/admin/club-member.php'));

/**
 * Induction
 */
Route::namespace('Induction')->name('induction.')->group(base_path('routes/api/admin/induction.php'));

/**
 * Membership
 */
Route::namespace('Membership')->name('membership.')->group(base_path('routes/api/admin/membership.php'));

/**
 * MembershipType
 */
Route::namespace('MembershipType')->name('membership-type.')->group(base_path('routes/api/admin/membership-type.php'));

/**
 * MembershipTypeName
 */
Route::namespace('MembershipTypeName')->name('membership-type-name.')->group(base_path('routes/api/admin/membership-type-name.php'));

/**
 * SuperAdmin
 */
Route::namespace('SuperAdmin')->name('super-admin.')->group(base_path('routes/api/admin/super-admin.php'));

/**
 * User
 */
Route::namespace('User')->name('user.')->group(base_path('routes/api/admin/user.php'));

/**
 * Vehicle
 */
Route::namespace('Vehicle')->name('vehicle.')->group(base_path('routes/api/admin/vehicle.php'));

/**
 * Laravel Passport
 */
Route::post('oauth/token', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');
