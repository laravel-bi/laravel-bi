<?php

namespace LaravelBi\LaravelBi\Filters;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use LaravelBi\LaravelBi\Support\BiRequest;

class DateFilter extends BaseFilter
{
    public $component = 'date';

    public function apply(Builder $builder, array $filterData, BiRequest $request): Builder
    {
        $start = Carbon::createFromFormat('Y-m-d', $filterData['start']);
        $end   = Carbon::createFromFormat('Y-m-d', $filterData['end']);

        return $builder->whereBetween($this->column, [$start, $end]);
    }
}
