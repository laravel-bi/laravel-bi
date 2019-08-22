<?php

namespace LaravelBi\LaravelBi\Http\Controllers\Apis;

use LaravelBi\LaravelBi\Dashboard;
use LaravelBi\LaravelBi\Http\Controllers\BaseController;

class WidgetController extends BaseController
{

    public function getWidget(Dashboard $dashboard, $widget)
    {
        $widget = $dashboard->findWidgetOrFail($widget);

        return $widget->data();
    }

}
