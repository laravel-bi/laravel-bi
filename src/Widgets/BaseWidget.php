<?php

namespace LaravelBi\LaravelBi\Widgets;

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

    public static function create($key, $name)
    {
        return new static($key, $name);
    }

    public function width($width)
    {
        $this->width = $width;
        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'width' => $this->width,
            'key' => $this->key,
            'name' => $this->name,
            'component' => $this->component()
        ];
    }

}
