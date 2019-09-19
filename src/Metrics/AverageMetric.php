<?php

namespace LaravelBi\LaravelBi\Metrics;

use DB;
use Illuminate\Database\Eloquent\Builder;

class AverageMetric extends BaseMetric
{

    public function apply(Builder $builder, $widget)
    {
        return $builder->addSelect(DB::raw('AVG(' . $this->column . ') as `' . $this->key . '`'));
    }

}
