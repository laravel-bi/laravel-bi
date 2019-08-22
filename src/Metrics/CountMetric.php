<?php

namespace LaravelBi\LaravelBi\Metrics;

use Illuminate\Database\Eloquent\Builder;
use DB;

class CountMetric extends BaseMetric {

    public function apply(Builder $builder)
    {
        return $builder->addSelect(DB::raw('COUNT(*) as `count`'));
    }

}