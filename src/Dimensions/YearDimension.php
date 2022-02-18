<?php

namespace LaravelBi\LaravelBi\Dimensions;

class YearDimension extends DateDimension
{
    public function __construct($key, $name)
    {
        parent::__construct($key, $name);
        $this->sqlFormat('%Y');
        $this->carbonFormat('Y', 'year');
        $this->carbonFunctions('startOfYear', 'endOfYear');
    }
}
