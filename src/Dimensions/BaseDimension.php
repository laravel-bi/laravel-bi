<?php

namespace LaravelBi\LaravelBi\Dimensions;

abstract class BaseDimension implements Dimension
{
    public $key;
    public $name;
    public $column;

    public function __construct(string $key, string $name)
    {
        $this->key    = $key;
        $this->name   = $name;
        $this->column = $key;
    }

    public static function create(string $key, string $name): self
    {
        return new static($key, $name);
    }

    public function column(string $column): self
    {
        $this->column = $column;

        return $this;
    }

    public function display($value)
    {
        return $value;
    }
}
