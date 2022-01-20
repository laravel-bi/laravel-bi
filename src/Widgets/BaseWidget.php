<?php

namespace LaravelBi\LaravelBi\Widgets;

use Closure;
use stdClass;
use LaravelBi\LaravelBi\Dashboard;
use Illuminate\Database\Eloquent\Builder;
use LaravelBi\LaravelBi\Support\BiRequest;

abstract class BaseWidget implements \JsonSerializable, Widget
{
    use Traits\HasAttributes;

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

    protected function extra(): array
    {
        return [
            'uniqid' => uniqid()
        ];
    }

    public function data(Dashboard $dashboard, BiRequest $request)
    {
        $builder = $this->getBaseBuilder($dashboard);
        $builder = $this->applyAttributes($builder);
        $builder = $this->applyFilters($builder, $dashboard, $request);

        $rawModels      = $builder->get();
        $rawModelsArray = $rawModels->toArray();

        return $rawModels->map(function ($rawModel) use ($rawModelsArray) {
            return $this->displayModel($rawModel, $rawModelsArray);
        });
    }

    public function jsonSerialize(): mixed
    {
        return [
            'width'      => $this->width,
            'key'        => $this->key,
            'name'       => $this->name,
            'component'  => $this->component,
            'metrics'    => $this->metrics,
            'dimensions' => $this->dimensions,
            'extra'      => $this->extra()
        ];
    }

    protected function getBaseBuilder(Dashboard $dashboard): Builder
    {
        $builder = $dashboard->model::query();
        $builder = $this->scope->call($this, $builder);

        return $builder;
    }

    protected function applyAttributes(Builder $builder): Builder
    {
        $this->getAttributes()->reduce(function ($builder, $attribute) {
            return $attribute->apply($builder, $this);
        }, $builder);

        return $builder;
    }

    protected function applyFilters(Builder $builder, Dashboard $dashboard, BiRequest $request)
    {
        $requestedFilters = $request->filters();

        return collect($dashboard->filters())->reduce(function (Builder $builder, $filter) use ($request, $requestedFilters) {
            if (isset($requestedFilters[$filter->key])) {
                return $filter->apply($builder, $requestedFilters[$filter->key], $request);
            }

            return $builder;
        }, $builder);
    }

    protected function displayModel($model, $rawModels)
    {
        return $this->getAttributes()->reduce(function ($item, $attribute) use ($model, $rawModels) {
            $item->{$attribute->key} = $attribute->display($model, $rawModels);

            return $item;
        }, new stdClass);
    }
}
