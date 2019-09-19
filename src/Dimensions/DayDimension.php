<?php

namespace LaravelBi\LaravelBi\Dimensions;

use DB;
use LaravelBi\LaravelBi\Widgets\Widget;
use Illuminate\Database\Eloquent\Builder;

class DayDimension extends BaseDimension
{

    public function apply(Builder $builder, Widget $widget): Builder
    {
        return $builder->addSelect(DB::raw("DATE_FORMAT({$this->key}, '%Y-%m-%d') as {$this->key}"))
                       ->groupBy(DB::raw("DATE_FORMAT({$this->key}, '%Y-%m-%d')"));
    }

}
