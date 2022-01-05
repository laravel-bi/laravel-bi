<?php

namespace LaravelBi\LaravelBi\Http\Controllers\Apis;

use LaravelBi\LaravelBi\Dashboard;
use LaravelBi\LaravelBi\Support\BiRequest;
use LaravelBi\LaravelBi\Http\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function getDashboards(BiRequest $request)
    {
        return [
            'status' => 200,
            'data'   => $this->dashboardResolver->all()->values()
        ];
    }

    public function getWidgets(Dashboard $dashboard, BiRequest $request)
    {
        return [
            'status' => 200,
            'data'   => $dashboard
        ];
    }
}
