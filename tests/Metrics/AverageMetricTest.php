<?php

namespace LaravelBi\LaravelBi\Tests\Metrics;

use LaravelBi\LaravelBi\Metrics\Metric;
use LaravelBi\LaravelBi\Metrics\AverageMetric;

class AverageMetricTest extends AbstractMetricTest
{
    protected function buildMetric(): Metric
    {
        return AverageMetric::create('average', 'Average')->column('column');
    }

    protected function getQuery(): string
    {
        return 'select AVG(column) as `average` from `foo`';
    }
}
