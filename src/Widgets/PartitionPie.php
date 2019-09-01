<?php

namespace LaravelBi\LaravelBi\Widgets;

use Illuminate\Http\Request;
use LaravelBi\LaravelBi\Dashboard;

class PartitionPie extends BaseWidget
{
    protected $metric;
    protected $dimension;
    protected $component = 'partition-pie';

    public function metric($metric)
    {
        $this->metric = $metric;
        return $this;
    }

    public function dimension($dimension)
    {
        $this->dimension = $dimension;
        return $this;
    }

    public function data(Dashboard $dashboard, Request $request)
    {
        $builder = $this->getBaseBuilder($dashboard, $request);
        $builder = $this->dimension->apply($builder, $this);
        $builder = $this->metric->apply($builder, $this);
        return $builder->get();
    }

    protected function extra()
    {
        return [
            'metric'    => $this->metric,
            'dimension' => $this->dimension
        ];
    }

}
