<?php

/**
 *
 * Route::namespace('Web')->name('web.')->group(base_path('routes/web/admin/base.php'));
 * Route::namespace('Club')->name('club.')->group(base_path('routes/web/admin/club.php'));
 *
 */

Route::resource('clubs', 'ClubController', ['except' => ['store', 'update', 'destroy',]])->names([
    'index' => 'index',
    'create' => 'create',
    'show' => 'show',
    'edit' => 'edit',
]);
