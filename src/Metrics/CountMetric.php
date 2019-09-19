<?php

namespace LaravelBi\LaravelBi\Metrics;

use DB;
use Illuminate\Database\Eloquent\Builder;

class CountMetric extends BaseMetric
{

    public function apply(Builder $builder, $widget)
    {
        return $builder->addSelect(DB::raw('COUNT(*) as `' . $this->key . '`'));
    }

}
