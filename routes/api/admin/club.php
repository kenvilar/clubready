<?php

/**
 *
 * Route::namespace('Api')->name('api.')->group(base_path('routes/api/admin/base.php'));
 * Route::namespace('Club')->name('club.')->group(base_path('routes/api/admin/club.php'));
 *
 */

Route::resource('clubs', 'ClubController', ['except' => ['create', 'edit']]);
