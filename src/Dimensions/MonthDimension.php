<?php

namespace LaravelBi\LaravelBi\Dimensions;

class MonthDimension extends DateDimension
{
    public function __construct($key, $name)
    {
        parent::__construct($key, $name);
        $this->sqlFormat('%Y-%m');
        $this->carbonFormat('Y-m', 'month');
        $this->carbonFunctions('startOfMonth', 'endOfMonth');
    }
}
