<?php

namespace LaravelBi\LaravelBi\Metrics;

abstract class BaseMetric implements Metric
{
    public $key;
    public $name;
    public $column;
    public $color;

    public function __construct($key, $name)
    {
        $this->key    = $key;
        $this->name   = $name;
        $this->column = $key;
    }

    public static function create($key, $name)
    {
        return new static($key, $name);
    }

    public function column($column)
    {
        $this->column = $column;

        return $this;
    }

    public function color($color)
    {
        $this->color = $color;

        return $this;
    }
}
