<?php

namespace LaravelBi\LaravelBi\Filters;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class DateFilter extends BaseFilter
{
    public $component = 'date';

    public function apply(Builder $builder, array $filterData, Request $request): Builder
    {
        $start = Carbon::createFromFormat('Y-m-d', $filterData['start']);
        $end   = Carbon::createFromFormat('Y-m-d', $filterData['end']);

        return $builder->whereBetween($this->column, [$start, $end]);
    }
}
