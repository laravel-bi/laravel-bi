<?php

namespace LaravelBi\LaravelBi\Tests\Dimensions;

use LaravelBi\LaravelBi\Dimensions\Dimension;
use LaravelBi\LaravelBi\Dimensions\DayDimension;

class DayDimensionTest extends AbstractDimensionTest
{
    protected function buildDimension(): Dimension
    {
        return DayDimension::create('dimension', 'Dimension')->column('column');
    }

    protected function getQuery(): string
    {
        return 'select DATE_FORMAT(column, \'%Y-%m-%d\') as `dimension` from `foo` group by DATE_FORMAT(column, \'%Y-%m-%d\')';
    }
}
