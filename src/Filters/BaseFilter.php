<?php

namespace LaravelBi\LaravelBi\Filters;

use Illuminate\Http\Request;
use LaravelBi\LaravelBi\Dashboard;
use Illuminate\Database\Eloquent\Builder;

abstract class BaseFilter implements Filter
{
    public $key;
    public $name;
    public $column;

    abstract public function apply(Builder $builder, array $filterData, Request $request);

    public function __construct($key, $name)
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

    public function data(Dashboard $dashboard, Request $request)
    {
        return [];
    }
}
