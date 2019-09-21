<?php

namespace LaravelBi\LaravelBi\Dimensions;

use LaravelBi\LaravelBi\Widgets\Widget;
use Illuminate\Database\Eloquent\Builder;

interface Dimension
{
    public function apply(Builder $builder, Widget $widget): Builder;
}
