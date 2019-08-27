<?php

namespace LaravelBi\LaravelBi\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class BaseFilter implements Filter
{

    public $key;
    public $name;

    abstract public function apply(Builder $builder, Request $request);

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
