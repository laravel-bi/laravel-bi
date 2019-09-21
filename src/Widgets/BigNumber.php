<?php

namespace LaravelBi\LaravelBi\Widgets;

use Illuminate\Http\Request;
use LaravelBi\LaravelBi\Dashboard;
use Illuminate\Database\Eloquent\Model;
use LaravelBi\LaravelBi\Metrics\Metric;

class BigNumber extends BaseWidget
{

    protected $metric;
    protected $component = 'big-number';

    public function metric(Metric $metric): self
    {
        $this->metric = $metric;

        return $this;
    }

    public function rawData(Dashboard $dashboard, Request $request): Model
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
