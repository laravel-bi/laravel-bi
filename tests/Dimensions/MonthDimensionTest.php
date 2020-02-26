<?php

namespace LaravelBi\LaravelBi\Tests\Dimensions;

use LaravelBi\LaravelBi\Dimensions\Dimension;
use LaravelBi\LaravelBi\Dimensions\MonthDimension;

class MonthDimensionTest extends AbstractDimensionTest
{
    protected function buildDimension(): Dimension
    {
        return MonthDimension::create('dimension', 'Dimension')->column('column');
    }

    protected function getQuery(): string
    {
        return 'select DATE_FORMAT(column, \'%Y-%m\') as `formatted_dimension` from `foo` group by `formatted_dimension`';
    }
}
