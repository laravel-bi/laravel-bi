<?php

namespace LaravelBi\LaravelBi\Http\Controllers\Apis;

use LaravelBi\LaravelBi\Dashboard;
use LaravelBi\LaravelBi\Http\Controllers\BaseController;

class DashboardController extends BaseController
{

    public function getDashboards()
    {
        return [
            'status' => 200,
            'data'   => $this->dashboardResolver->all()->values()->map(function (Dashboard $dashboard) {
                return [
                    'name'   => $dashboard->name(),
                    'uriKey' => $dashboard->uriKey()
                ];
            })
        ];
    }

    public function getWidgets(Dashboard $dashboard)
    {
        return $dashboard->toArray();
    }

}
