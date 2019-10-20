<?php

namespace LaravelBi\LaravelBi\Widgets\Traits;

use LaravelBi\LaravelBi\Metrics\Metric;
use LaravelBi\LaravelBi\Support\AttributeCollection;

trait SingleMetric
{
    protected $metric;
    protected $metrics;

    public function metric(Metric $metric): self
    {
        $this->metric = $metric;
        $this->metric = new AttributeCollection([$this->metric]);

        return $this;
    }
}
