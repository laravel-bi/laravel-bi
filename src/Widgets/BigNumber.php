<?php

namespace LaravelBi\LaravelBi\Widgets;

use Illuminate\Http\Request;
use LaravelBi\LaravelBi\Dashboard;

class BigNumber extends BaseWidget
{

    protected $metric;
    protected $component = 'big-number';

    public function metric($metric)
    {
        $this->metric = $metric;
        return $this;
    }

    public function data(Dashboard $dashboard, Request $request)
    {
        $builder = $this->getBaseBuilder($dashboard, $request);
        $builder = $this->metric->apply($builder, $this);
        return $builder->first();
    }

    protected function extra()
    {
        return [
            'metric' => $this->metric
        ];
    }

}
