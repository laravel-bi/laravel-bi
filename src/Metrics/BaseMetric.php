<?php

namespace LaravelBi\LaravelBi\Metrics;

abstract class BaseMetric {

    static public function create()
    {
        return new static;
    }

}