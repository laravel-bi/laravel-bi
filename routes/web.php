<?php

Route::group(['middleware' => 'can:viewBi'], function () {
    Route::get('/', 'HomepageController@getIndex');
    Route::get('/{dashboard}', 'HomepageController@getDashboard')
        ->name('dashboard');
});
