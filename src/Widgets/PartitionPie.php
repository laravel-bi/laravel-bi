<?php

namespace LaravelBi\LaravelBi\Widgets;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use LaravelBi\LaravelBi\Dashboard;
use LaravelBi\LaravelBi\Dimensions\Dimension;
use LaravelBi\LaravelBi\Metrics\Metric;

class PartitionPie extends BaseWidget
{
    protected $metric;
    protected $dimension;
    protected $component = 'partition-pie';

    public function metric(Metric $metric): self
    {
        $this->metric = $metric;
        return $this;
    }

    public function dimension(Dimension $dimension): self
    {
        $this->dimension = $dimension;
        return $this;
    }

    public function data(Dashboard $dashboard, Request $request): Collection
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
