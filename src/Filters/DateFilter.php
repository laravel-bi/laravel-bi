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
        $date = Carbon::createFromFormat('Y-m-d', $filterData[0]);

        return $builder->whereBetween($this->column, [$date->copy()->startOfDay(), $date->endOfDay()]);
    }

    public function defaultDate(Carbon $date)
    {
        $this->defaultValue([$date->format('Y-m-d')]);

        return $this;
    }
}
