<?php

/**
 *
 * Route::namespace('Api')->name('api.')->group(base_path('routes/api/admin/base.php'));
 * Route::namespace('Vehicle')->name('vehicle.')->group(base_path('routes/api/admin/vehicle.php'));
 *
 */

Route::resource('vehicles', 'VehicleController', ['except' => ['create', 'edit']]);
