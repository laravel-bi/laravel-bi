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
        return 'select DATE_FORMAT(column, \'%Y\') as `dimension` from `foo` group by DATE_FORMAT(column, \'%Y\')';
    }
}
