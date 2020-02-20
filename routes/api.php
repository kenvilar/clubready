<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Club
 */
Route::resource('clubs', 'Api\Club\ClubController', ['except' => ['create', 'edit']]);

/**
 * ClubMember
 */
Route::resource('club-members', 'Api\ClubMember\ClubMemberController', ['except' => ['create', 'edit']]);

/**
 * Induction
 */
Route::resource('inductions', 'Api\Induction\InductionController', ['except' => ['create', 'edit']]);

/**
 * Membership
 */
Route::resource('memberships', 'Api\Membership\MembershipController', ['except' => ['create', 'edit']]);

/**
 * MembershipType
 */
Route::resource('membership-types', 'Api\MembershipType\MembershipTypeController', ['except' => ['create', 'edit']]);

/**
 * MembershipTypeName
 */
Route::resource('membership-type-names', 'Api\MembershipTypeName\MembershipTypeNameController', ['except' => ['create', 'edit']]);

/**
 * SuperAdmin
 */
Route::resource('super-admins', 'Api\SuperAdmin\SuperAdminController', ['except' => ['create', 'edit']]);

/**
 * Users
 */
Route::resource('users', 'Api\User\UserController', ['except' => ['create', 'edit']]);

/**
 * Vehicle
 */
Route::resource('vehicles', 'Api\Vehicle\VehicleController', ['except' => ['create', 'edit']]);
