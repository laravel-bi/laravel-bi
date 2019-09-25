<?php

namespace LaravelBi\LaravelBi\Tests\Metrics;

use LaravelBi\LaravelBi\Metrics\Metric;
use LaravelBi\LaravelBi\Metrics\CountMetric;

class CountMetricTest extends AbstractMetricTest
{
    protected function buildMetric(): Metric
    {
        return CountMetric::create('count', 'Count');
    }

    protected function getQuery(): string
    {
        return 'select COUNT(*) as `count` from `foo`';
    }
}
