<?php

Route::get('/dashboards', 'DashboardController@getDashboards');
Route::get('/{dashboard}/widgets', 'DashboardController@getWidgets');

Route::get('/{dashboard}/{widget}', 'WidgetController@getWidget');