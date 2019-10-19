<?php

namespace LaravelBi\LaravelBi\Widgets;

use Illuminate\Http\Request;
use LaravelBi\LaravelBi\Dashboard;
use Illuminate\Support\Collection;
use LaravelBi\LaravelBi\Dimensions\Dimension;

class LineChart extends BaseWidget
{
    protected $metrics;
    protected $dimension;
    protected $component = 'line-chart';

    public function metrics(array $metrics): self
    {
        $this->metrics = $metrics;

        return $this;
    }

    public function dimension(Dimension $dimension): self
    {
        $this->dimension = $dimension;

        return $this;
    }

    public function rawData(Dashboard $dashboard, Request $request): Collection
    {
        $builder = $this->getBaseBuilder($dashboard, $request);
        $builder = $this->dimension->apply($builder, $this);
        $builder = collect($this->metrics)->reduce(function ($builder, $metric) {
            return $metric->apply($builder, $this);
        }, $builder);

        return $builder->get();
    }

    protected function extra()
    {
        return [
            'metrics'   => $this->metrics,
            'dimension' => $this->dimension
        ];
    }
}
