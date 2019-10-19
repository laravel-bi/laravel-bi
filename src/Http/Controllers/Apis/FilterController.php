<?php

namespace LaravelBi\LaravelBi\Http\Controllers\Apis;

use Illuminate\Http\Request;
use LaravelBi\LaravelBi\Dashboard;
use LaravelBi\LaravelBi\Http\Controllers\BaseController;

class FilterController extends BaseController
{
    public function getFilter(Dashboard $dashboard, string $filterKey, Request $request)
    {
        $filter = $dashboard->findFilterOrFail($filterKey);

        return [
            'status' => 200,
            'extra'  => $filter->extra($dashboard, $request)
        ];
    }
}
