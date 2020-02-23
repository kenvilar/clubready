<?php

/**
 *
 * Route::namespace('Api')->name('api.')->group(base_path('routes/api/admin/base.php'));
 * Route::namespace('Induction')->name('induction.')->group(base_path('routes/api/admin/induction.php'));
 *
 */

Route::resource('inductions', 'InductionController', ['except' => ['create', 'edit']]);
