<?php

namespace LaravelBi\LaravelBi\Dimensions;

class DayDimension extends DateDimension
{
    public function __construct($key, $name)
    {
        parent::__construct($key, $name);
        $this->format('%Y-%m-%d');
    }
}
