<?php

namespace LaravelBi\LaravelBi\Metrics;

use DB;
use LaravelBi\LaravelBi\Widgets\Widget;
use Illuminate\Database\Eloquent\Builder;

class CountMetric extends BaseMetric
{
    public function apply(Builder $builder, Widget $widget): Builder
    {
        return $builder->addSelect(DB::raw('COUNT(*) as `' . $this->key . '`'));
    }
}
