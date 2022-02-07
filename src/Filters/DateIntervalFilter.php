<?php

namespace LaravelBi\LaravelBi\Filters;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use LaravelBi\LaravelBi\Support\BiRequest;

class DateIntervalFilter extends BaseFilter
{
    public $component = 'date-interval';

    public function apply(Builder $builder, array $filterData, BiRequest $request): Builder
    {
        $start = Carbon::createFromFormat('Y-m-d', $filterData['start']);
        $end   = Carbon::createFromFormat('Y-m-d', $filterData['end']);

        return $builder->whereBetween($this->column, [$start, $end]);
    }

    public function defaultDates(Carbon $startDate, Carbon $endDate)
    {
        $this->defaultValue([
            'start' => $startDate->format('Y-m-d'),
            'end' => $endDate->format('Y-m-d')
        ]);

        return $this;
    }
}
