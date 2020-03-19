<?php

/**
 *
 * Route::namespace('Web')->name('web.')->group(base_path('routes/web/admin/base.php'));
 * Route::namespace('Induction')->name('induction.')->group(base_path('routes/web/admin/induction.php'));
 *
 */

Route::resource('inductions', 'InductionController', ['except' => ['store', 'update', 'destroy',]])
    ->names([
        'index' => 'index',
        'create' => 'create',
        'show' => 'show',
        'edit' => 'edit',
    ]);
