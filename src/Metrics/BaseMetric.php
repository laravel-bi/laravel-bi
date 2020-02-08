<?php

namespace LaravelBi\LaravelBi\Metrics;

use LaravelBi\LaravelBi\Attribute;

abstract class BaseMetric extends Attribute implements Metric
{
    public function getEmptyValue()
    {
        return 0;
    }
}
