<?php

namespace LaravelBi\LaravelBi\Tests\Dimensions;

use LaravelBi\LaravelBi\Dimensions\Dimension;
use LaravelBi\LaravelBi\Dimensions\RawDimension;

class RawDimensionTest extends AbstractDimensionTest
{
    protected function buildDimension(): Dimension
    {
        return RawDimension::create('dimension', 'Dimension')->raw('CONCAT(firstname, \' \', lastname)');
    }

    protected function getQuery(): string
    {
        return 'select CONCAT(firstname, \' \', lastname) as `dimension` from `foo` group by `dimension`';
    }
}
