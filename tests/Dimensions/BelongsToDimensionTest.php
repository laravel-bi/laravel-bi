<?php

namespace LaravelBi\LaravelBi\Tests\Dimensions;

use LaravelBi\LaravelBi\Dimensions\Dimension;
use LaravelBi\LaravelBi\Dimensions\BelongsToDimension;

class BelongsToDimensionTest extends AbstractDimensionTest
{
    protected function buildDimension(): Dimension
    {
        return BelongsToDimension::create('bar', 'Bar')->otherColumn('name');
    }

    protected function getQuery(): string
    {
        return 'select * from `foo` group by `bar`';
    }
}
