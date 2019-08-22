<?php

namespace LaravelBi\LaravelBi\Widgets;

use LaravelBi\Dashboard;

class Table extends BaseWidget
{

    public $metrics;
    public $dimensions;
    public $model;

    public function component()
    {
        return 'table';
    }

    public function model($model)
    {
        $this->model = $model;
        return $this;
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

    public function data()
    {
        $builder = $this->model::query();
        $builder = collect($this->dimensions)->reduce(function ($builder, $dimension) {
            return $dimension->apply($builder, $this);
        }, $builder);
        $builder = collect($this->metrics)->reduce(function ($builder, $metric) {
            return $metric->apply($builder, $this);
        }, $builder);
        return $builder->get();
    }

    protected function getMeta() 
    {
        return [
            'metrics' => $this->metrics,
            'dimensions' => $this->dimensions,
        ];
    }

}
