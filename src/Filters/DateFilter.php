<?php

namespace LaravelBi\LaravelBi\Filters;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DateFilter extends BaseFilter
{

    public function apply(Builder $builder, Request $request)
    {
        return $builder->whereBetween($this->key, [Carbon::today()->subMonths(3), Carbon::today()->subMonths(2)]);
    }
}
