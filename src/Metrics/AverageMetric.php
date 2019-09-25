<?php

namespace LaravelBi\LaravelBi\Metrics;

use DB;
use LaravelBi\LaravelBi\Widgets\Widget;
use Illuminate\Database\Eloquent\Builder;

class AverageMetric extends BaseMetric
{
    public function apply(Builder $builder, Widget $widget): Builder
    {
        return $builder->addSelect(DB::raw('AVG(' . $this->column . ') as `' . $this->key . '`'));
    }
}
