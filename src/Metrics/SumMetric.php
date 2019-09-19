<?php

namespace LaravelBi\LaravelBi\Metrics;

use DB;
use Illuminate\Database\Eloquent\Builder;

class SumMetric extends BaseMetric
{

    public function apply(Builder $builder, $widget)
    {
        return $builder->addSelect(DB::raw('SUM(' . $this->column . ') as `' . $this->key . '`'));
    }

}
