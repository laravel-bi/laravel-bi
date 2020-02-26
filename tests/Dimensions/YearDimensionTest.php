<?php

namespace LaravelBi\LaravelBi\Tests\Dimensions;

use LaravelBi\LaravelBi\Dimensions\Dimension;
use LaravelBi\LaravelBi\Dimensions\YearDimension;

class YearDimensionTest extends AbstractDimensionTest
{
    protected function buildDimension(): Dimension
    {
        return YearDimension::create('dimension', 'Dimension')->column('column');
    }

    protected function getQuery(): string
    {
        return 'select DATE_FORMAT(column, \'%Y\') as `formatted_dimension` from `foo` group by `formatted_dimension`';
    }
}
