<?php

namespace LaravelBi\LaravelBi\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use LaravelBi\LaravelBi\Dashboard;

class NumberFilter extends BaseFilter
{

    public $component = 'number';

    public function apply(Builder $builder, array $filterData, Request $request): Builder
    {
        if ($filterData['operator'] == 'between') {
            return $builder->whereBetween($this->column, $filterData['values']);
        } else {
            return $builder->where($this->column, $filterData['operator'], $filterData['values'][0]);
        }
    }

}
