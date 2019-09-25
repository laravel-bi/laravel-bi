<?php

namespace LaravelBi\LaravelBi\Tests\Dimensions;

use LaravelBi\LaravelBi\Dimensions\Dimension;
use LaravelBi\LaravelBi\Dimensions\StringDimension;

class StringDimensionTest extends AbstractDimensionTest
{
    protected function buildDimension(): Dimension
    {
        return StringDimension::create('dimension', 'Dimension')->column('column');
    }

    protected function getQuery(): string
    {
        return 'select `column` as `dimension` from `foo` group by `dimension`';
    }
}
