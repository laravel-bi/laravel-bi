<?php

namespace LaravelBi\LaravelBi\Widgets;

use LaravelBi\LaravelBi\Metric\BaseMetric;

class BigNumber extends BaseWidget
{

    protected $metric;
    protected $model;

    public function component()
    {
        return 'big-number';
    }

    public function model($model)
    {
        $this->model = $model;
        return $this;
    }

    public function metric($metric)
    {
        $this->metric = $metric;
        return $this;
    }

    public function data()
    {
        $builder = $this->model::query();
        $builder = $this->metric->apply($builder);
        return $builder->get();
    }

}
