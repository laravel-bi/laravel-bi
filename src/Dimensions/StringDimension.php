<?php

namespace LaravelBi\LaravelBi\Dimensions;

use Illuminate\Database\Eloquent\Builder;
use LaravelBi\Widgets\BaseWidget;

class StringDimension extends BaseDimension
{

    public function apply(Builder $builder, $widget)
    {
        return $builder->addSelect($this->key)
                       ->groupBy($this->key);
    }

}
