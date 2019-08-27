<?php

namespace LaravelBi\LaravelBi\Http\Controllers\Apis;

use Illuminate\Http\Request;
use LaravelBi\LaravelBi\Dashboard;
use LaravelBi\LaravelBi\Http\Controllers\BaseController;
use LaravelBi\LaravelBi\Widgets\Widget;

class WidgetController extends BaseController
{

    public function getWidget(Dashboard $dashboard, $widget, Request $request)
    {
        $widget = $dashboard->findWidgetOrFail($widget);

        return [
            'status' => 200,
            'data'   => $widget->data($dashboard, $request)
        ];
    }

}
