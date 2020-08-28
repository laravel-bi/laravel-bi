<?php

Route::group(['middleware' => ['auth', 'can:viewBi']], function () {
    Route::get('/', 'HomepageController@getIndex');
    Route::get('/{dashboard}', 'HomepageController@getDashboard')
        ->name('dashboard');
});
