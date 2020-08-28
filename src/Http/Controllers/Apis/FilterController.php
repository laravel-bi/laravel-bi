<?php

namespace LaravelBi\LaravelBi\Http\Controllers\Apis;

use LaravelBi\LaravelBi\Dashboard;
use LaravelBi\LaravelBi\Http\Controllers\BaseController;
use LaravelBi\LaravelBi\Support\BiRequest;

class FilterController extends BaseController
{
    public function getFilter(Dashboard $dashboard, string $filterKey, BiRequest $request)
    {
        $filter = $dashboard->findFilterOrFail($filterKey);

        return [
            'status' => 200,
            'extra'  => $filter->extra($dashboard, $request)
        ];
    }
}
