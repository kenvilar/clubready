<?php

/**
 *
 * Route::namespace('Web')->name('web.')->group(base_path('routes/web/admin/base.php'));
 * Route::namespace('ClubMember')->name('club-member.')->group(base_path('routes/web/admin/club-member.php'));
 *
 */

Route::resource('club-member', 'ClubMemberController', ['except' => ['store', 'update', 'destroy',]]);
