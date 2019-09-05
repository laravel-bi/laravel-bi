<?php

namespace LaravelBi\LaravelBi\Dimensions;

abstract class BaseDimension implements Dimension
{

    public $key;
    public $name;

    public function __construct($key, $name)
    {
        $this->key  = $key;
        $this->name = $name;
    }

    public static function create($key, $name): self
    {
        return new static($key, $name);
    }

}
