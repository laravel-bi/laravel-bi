<?php

namespace LaravelBi\LaravelBi\Metrics;

use DB;
use Illuminate\Database\Eloquent\Builder;
use LaravelBi\LaravelBi\Widgets\Widget;

class CountMetric extends BaseMetric
{

    public function apply(Builder $builder, Widget $widget): Builder
    {
        return $builder->addSelect(DB::raw('COUNT(*) as `' . $this->key . '`'));
    }

}
