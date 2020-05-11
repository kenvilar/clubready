<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('admin', 'HomeController@index')->name('home');

Route::prefix('admin')->group(function () {
    Route::get('choose-club', 'HomeController@chooseClub')->name('chooseClub');
    Route::post('selected-club', 'HomeController@selectedClub')->name('selectedClub');

    // display all values of session, display only if APP_DEBUG is true
    Route::get('get-all-session-data', 'HomeController@getAllSessionData')->name('getAllSessionData');
});

Route::prefix('admin')->namespace('Web')->name('web.')->group(base_path('routes/web/admin/base.php'));
