<?php

namespace LaravelBi\LaravelBi\Widgets;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use LaravelBi\LaravelBi\Dashboard;

abstract class BaseWidget implements \JsonSerializable, Widget
{

    public $width;
    public $key;
    public $name;

    public function __construct($key, $name)
    {
        $this->key  = $key;
        $this->name = $name;
    }

    abstract public function data(Dashboard $dashboard, Request $request);

    public static function create($key, $name): Widget
    {
        return new static($key, $name);
    }

    public function width($width)
    {
        $this->width = $width;
        return $this;
    }

    protected function extra()
    {
        return new \stdClass;
    }

    protected function getBaseBuilder(Dashboard $dashboard, Request $request): Builder
    {
        return collect($dashboard->filters())->reduce(function (Builder $builder, $filter) use ($request) {
            return $filter->apply($builder, $request);
        }, $dashboard->model::query());
    }

    public function jsonSerialize()
    {
        return [
            'width'     => $this->width,
            'key'       => $this->key,
            'name'      => $this->name,
            'component' => $this->component,
            'extra'     => $this->extra()
        ];
    }

}
