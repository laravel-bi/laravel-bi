<?php

namespace LaravelBi\LaravelBi\Widgets;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use LaravelBi\LaravelBi\Dashboard;

class Table extends BaseWidget
{

    protected $metrics;
    protected $dimensions;
    protected $component = 'table';

    public function metrics(array $metrics): Table
    {
        $this->metrics = $metrics;
        return $this;
    }

    public function dimensions(array $dimensions): Table
    {
        $this->dimensions = $dimensions;
        return $this;
    }

    public function data(Dashboard $dashboard, Request $request): Collection
    {
        $builder = $this->getBaseBuilder($dashboard, $request);
        $builder = collect($this->dimensions)->reduce(function ($builder, $dimension) {
            return $dimension->apply($builder, $this);
        }, $builder);
        $builder = collect($this->metrics)->reduce(function ($builder, $metric) {
            return $metric->apply($builder, $this);
        }, $builder);
        $builder->orderBy($request->input('sort')['col'], $request->input('sort')['dir']);
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
