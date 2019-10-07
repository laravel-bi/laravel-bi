<?php

namespace LaravelBi\LaravelBi\Widgets;

use Closure;
use Illuminate\Http\Request;
use LaravelBi\LaravelBi\Dashboard;
use Illuminate\Database\Eloquent\Builder;

abstract class BaseWidget implements \JsonSerializable, Widget
{
    public $width;
    public $key;
    public $name;
    public $scope;

    public function __construct($key, $name)
    {
        $this->key   = $key;
        $this->name  = $name;
        $this->scope = function (Builder $builder) {
            return $builder;
        };
    }

    abstract public function rawData(Dashboard $dashboard, Request $request);

    public static function create($key, $name): Widget
    {
        return new static($key, $name);
    }

    public function width($width)
    {
        $this->width = $width;

        return $this;
    }

    public function scope(Closure $scope): Widget
    {
        $this->scope = $scope;

        return $this;
    }

    protected function extra()
    {
        return new \stdClass();
    }

    protected function getBaseBuilder(Dashboard $dashboard, Request $request): Builder
    {
        $requestedFilters = $request->input('filters');
        $builder          = $dashboard->model::query();
        $builder          = collect($dashboard->filters())->reduce(function (Builder $builder, $filter) use ($request, $requestedFilters) {
            if (isset($requestedFilters[$filter->key])) {
                return $filter->apply($builder, $requestedFilters[$filter->key], $request);
            }

            return $builder;
        }, $builder);
        
        $builder = $this->scope->call($this, $builder);
        
        return $builder;
    }

    public function data(Dashboard $dashboard, Request $request)
    {
        return $this->rawData($dashboard, $request);
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
