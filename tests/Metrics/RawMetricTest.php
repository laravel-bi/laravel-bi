<?php

namespace LaravelBi\LaravelBi\Tests\Metrics;

use LaravelBi\LaravelBi\Metrics\Metric;
use LaravelBi\LaravelBi\Metrics\RawMetric;

class RawMetricTest extends AbstractMetricTest
{
    protected function buildMetric(): Metric
    {
        return RawMetric::create('raw', 'Raw')->raw('SUM(column) / 10');
    }

    protected function getQuery(): string
    {
        return 'select SUM(column) / 10 as `raw` from `foo`';
    }
}
