<?php

namespace LaravelBi\LaravelBi\Dimensions;

abstract class BaseDimension implements Dimension
{

    public $key;
    public $name;
    public $column;

    public function __construct($key, $name)
    {
        $this->key    = $key;
        $this->name   = $name;
        $this->column = $key;
    }

    public static function create($key, $name): self
    {
        return new static($key, $name);
    }

    public function column($column)
    {
        $this->column = $column;
        return $this;
    }

}
