<?php

namespace LaravelBi\LaravelBi\Filters;

use LaravelBi\LaravelBi\Dashboard;
use Illuminate\Database\Eloquent\Builder;
use LaravelBi\LaravelBi\Support\BiRequest;

class StringFilter extends BaseFilter
{
    public $component = 'string';

    public function apply(Builder $builder, array $filterData, BiRequest $request): Builder
    {
        return $builder->whereIn($this->column, $filterData);
    }

    public function extra(Dashboard $dashboard, BiRequest $request): array
    {
        return [
            'options' => $dashboard->model::query()->select($this->column)->distinct()->pluck($this->column)
        ];
    }
}
