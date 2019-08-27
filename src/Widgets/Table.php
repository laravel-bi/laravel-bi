<?php

namespace LaravelBi\LaravelBi\Widgets;

use Illuminate\Http\Request;
use LaravelBi\LaravelBi\Dashboard;

class Table extends BaseWidget
{

    protected $metrics;
    protected $dimensions;
    protected $component = 'table';

    public function component()
    {
        return 'table';
    }

    public function metrics($metrics)
    {
        $this->metrics = $metrics;
        return $this;
    }

    public function dimensions($dimensions)
    {
        $this->dimensions = $dimensions;
        return $this;
    }

    public function data(Dashboard $dashboard, Request $request)
    {
        $builder = $this->getBaseBuilder($dashboard, $request);
        $builder = collect($this->dimensions)->reduce(function ($builder, $dimension) {
            return $dimension->apply($builder, $this);
        }, $builder);
        $builder = collect($this->metrics)->reduce(function ($builder, $metric) {
            return $metric->apply($builder, $this);
        }, $builder);
        return $builder->get();
    }

    protected function extra()
    {
        return [
            'metrics'    => $this->metrics,
            'dimensions' => $this->dimensions
        ];
    }

}
