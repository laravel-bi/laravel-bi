<?php

namespace LaravelBi\LaravelBi\Dimensions;

use Illuminate\Database\Eloquent\Builder;
use LaravelBi\LaravelBi\Widgets\Widget;

class StringDimension extends BaseDimension
{

    public function apply(Builder $builder, Widget $widget): Builder
    {
        return $builder->addSelect($this->key)
                       ->groupBy($this->key);
    }

}
