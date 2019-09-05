<?php

namespace LaravelBi\LaravelBi\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DateFilter extends BaseFilter
{

    public $component = 'date';

    public function apply(Builder $builder, array $filterData, Request $request): Builder
    {
        return $builder->whereBetween($this->column, [$filterData['start'], $filterData['end']]);
    }
}
