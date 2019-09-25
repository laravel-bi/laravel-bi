<?php

namespace LaravelBi\LaravelBi\Tests\Metrics;

use LaravelBi\LaravelBi\Metrics\Metric;
use LaravelBi\LaravelBi\Metrics\SumMetric;

class SumMetricTest extends AbstractMetricTest
{
    protected function buildMetric(): Metric
    {
        return SumMetric::create('sum', 'Sum')->column('column');
    }

    protected function getQuery(): string
    {
        return 'select SUM(column) as `sum` from `foo`';
    }
}
