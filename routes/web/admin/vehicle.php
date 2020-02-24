<?php

/**
 *
 * Route::namespace('Web')->name('web.')->group(base_path('routes/web/admin/base.php'));
 * Route::namespace('Vehicle')->name('vehicle.')->group(base_path('routes/web/admin/vehicle.php'));
 *
 */

Route::resource('vehicles', 'VehicleController', ['except' => ['store', 'update', 'destroy',]]);
