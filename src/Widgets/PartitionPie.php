<?php

namespace LaravelBi\LaravelBi\Widgets;

use Illuminate\Http\Request;
use LaravelBi\LaravelBi\Dashboard;

class PartitionPie extends BaseWidget
{

    protected $component = 'partition-pie';

    public function data(Dashboard $dashboard, Request $request)
    {
        return [];
    }

}
