<?php

namespace LaravelBi\LaravelBi\Dimensions;

use Illuminate\Database\Eloquent\Model;
use LaravelBi\LaravelBi\Widgets\Widget;
use Illuminate\Database\Eloquent\Builder;

interface Dimension
{
    public function apply(Builder $builder, Widget $widget): Builder;

    public function display(Model $value, array $models);
}
