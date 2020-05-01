<?php

/**
 *
 * Route::namespace('Api')->name('api.')->group(base_path('routes/api/admin/base.php'));
 *
 */

/**
 * Club
 */
Route::namespace('Club')->group(base_path('routes/api/admin/club.php'));

/**
 * ClubMember
 */
Route::namespace('ClubMember')->group(base_path('routes/api/admin/club-member.php'));

/**
 * Induction
 */
Route::namespace('Induction')->group(base_path('routes/api/admin/induction.php'));

/**
 * Membership
 */
Route::namespace('Membership')->group(base_path('routes/api/admin/membership.php'));

/**
 * MembershipType
 */
Route::namespace('MembershipType')->group(base_path('routes/api/admin/membership-type.php'));

/**
 * MembershipTypeName
 */
Route::namespace('MembershipTypeName')->group(base_path('routes/api/admin/membership-type-name.php'));

/**
 * SuperAdmin
 */
Route::namespace('SuperAdmin')->group(base_path('routes/api/admin/super-admin.php'));

/**
 * User
 */
Route::namespace('User')->group(base_path('routes/api/admin/user.php'));

/**
 * Vehicle
 */
Route::namespace('Vehicle')->group(base_path('routes/api/admin/vehicle.php'));

/**
 * Laravel Passport
 */
Route::post('oauth/token', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');
