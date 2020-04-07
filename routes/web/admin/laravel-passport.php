<?php

/**
 *
 * Route::namespace('Web')->name('web.')->group(base_path('routes/web/admin/base.php'));
 * Route::namespace('Passport')->name('passport.')->group(base_path('routes/web/admin/laravel-passport.php'));
 *
 */

Route::get('passport-clients', 'PassportController@passportClients');
Route::get('passport-authorized-clients', 'PassportController@passportAuthorizedClients');
Route::get('passport-personal-access-tokens', 'PassportController@passportPersonalAccessTokens');
