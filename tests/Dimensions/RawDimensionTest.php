<?php

namespace LaravelBi\LaravelBi\Tests\Dimensions;

use LaravelBi\LaravelBi\Dimensions\Dimension;
use LaravelBi\LaravelBi\Dimensions\RawDimension;

class RawDimensionTest extends AbstractDimensionTest
{
    protected function buildDimension(): Dimension
    {
        return RawDimension::create('dimension', 'Dimension')->raw('SUM(col) / 100');
    }

    protected function getQuery(): string
    {
        return 'select SUM(col) / 100 as `dimension` from `foo` group by `dimension`';
    }
}
