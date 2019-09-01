<?php

namespace LaravelBi\LaravelBi\Filters;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DateFilter extends BaseFilter
{

    public $component = 'date';

    public function apply(Builder $builder, $filterData, Request $request)
    {
        return $builder->whereBetween($this->key, [$filterData['start'], $filterData['end']]);
    }
}
