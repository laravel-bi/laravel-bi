<?php

namespace LaravelBi\LaravelBi\Widgets;

use Illuminate\Http\Request;
use LaravelBi\LaravelBi\Dashboard;
use LaravelBi\LaravelBi\Metrics\Metric;
use Illuminate\Database\Eloquent\Collection;
use LaravelBi\LaravelBi\Dimensions\Dimension;

class PartitionPie extends BaseWidget
{
    protected $metric;
    protected $dimension;
    protected $colors;

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

    public function colors(array $colors): self
    {
        $this->colors = $colors;
        return $this;
    }

    public function rawData(Dashboard $dashboard, Request $request): Collection
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
            'dimension' => $this->dimension,
            'colors'    => $this->colors
        ];
    }

}
