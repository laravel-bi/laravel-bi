<?php

Route::get('/', 'HomepageController@getIndex');

Route::get('/{any}', 'HomepageController@getIndex')->where('any', '.*');