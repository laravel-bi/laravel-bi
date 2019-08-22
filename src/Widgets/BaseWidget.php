<?php

namespace LaravelBi\LaravelBi\Widgets;

use LaravelBi\Dashboard;

abstract class BaseWidget implements \JsonSerializable
{

    public $width;
    public $key;
    public $name;

    public function __construct($key, $name)
    {
        $this->key  = $key;
        $this->name = $name;
    }

    abstract public function component();
    abstract public function data();

    public static function create($key, $name)
    {
        return new static($key, $name);
    }

    public function width($width)
    {
        $this->width = $width;
        return $this;
    }

    protected function getMeta() 
    {
        return [];
    }

    public function jsonSerialize()
    {
        return [
            'width' => $this->width,
            'key' => $this->key,
            'name' => $this->name,
            'component' => $this->component(),
            'meta' => $this->getMeta()
        ];
    }

}
