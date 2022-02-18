<?php

namespace LaravelBi\LaravelBi\Dimensions;

class DayDimension extends DateDimension
{
    public function __construct($key, $name)
    {
        parent::__construct($key, $name);
        $this->sqlFormat('%Y-%m-%d');
        $this->carbonFormat('Y-m-d', 'day');
        $this->carbonFunctions('startOfDay', 'endOfDay');
    }
}
