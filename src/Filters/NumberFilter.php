<?php

namespace LaravelBi\LaravelBi\Filters;

use Illuminate\Database\Eloquent\Builder;
use LaravelBi\LaravelBi\Support\BiRequest;

class NumberFilter extends BaseFilter
{
    public $component = 'number';

    public function apply(Builder $builder, array $filterData, BiRequest $request): Builder
    {
        if (empty($filterData['operator'])) {
            return $builder;
        }
        if ($filterData['operator'] == 'between') {
            return $builder->whereBetween($this->column, $filterData['values']);
        } else {
            return $builder->where($this->column, $filterData['operator'], $filterData['values'][0]);
        }
    }
}
