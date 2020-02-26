<?php

namespace LaravelBi\LaravelBi\Metrics;

use Illuminate\Database\Eloquent\Model;
use LaravelBi\LaravelBi\Widgets\Widget;
use Illuminate\Database\Eloquent\Builder;

interface Metric
{
    public function apply(Builder $builder, Widget $widget): Builder;

    public function display(Model $value, array $models);

    public function getEmptyValue();
}
