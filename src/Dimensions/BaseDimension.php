<?php

namespace LaravelBi\LaravelBi\Dimensions;

abstract class BaseDimension
{

    public $key;
    public $name;

    public function __construct($key, $name)
    {
        $this->key  = $key;
        $this->name = $name;
    }

    public static function create($key, $name)
    {
        return new static($key, $name);
    }

}
