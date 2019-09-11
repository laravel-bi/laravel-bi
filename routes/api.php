<?php

Route::get('/dashboards', 'DashboardController@getDashboards');
Route::get('/{dashboard}/widgets', 'DashboardController@getWidgets');

Route::get('/{dashboard}/widgets/{widget}', 'WidgetController@getWidget');
Route::get('/{dashboard}/widgets/{widget}/csv', 'WidgetController@download');
Route::get('/{dashboard}/filters/{filter}', 'FilterController@getFilter');
