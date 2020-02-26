<?php

namespace LaravelBi\LaravelBi\Metrics;

use LaravelBi\LaravelBi\Attribute;
use Illuminate\Database\Eloquent\Model;

abstract class BaseMetric extends Attribute implements Metric
{
    private $asPercentage = false;

    public function getEmptyValue()
    {
        return 0;
    }

    public function asPercentage()
    {
        $this->asPercentage = true;

        return $this;
    }

    public function display(Model $value, array $models)
    {
        if ($this->asPercentage) {
            return round($value->{$this->key} / array_sum(array_column($models, $this->key)) * 100, 2) . '%';
        }

        return parent::display($value, $models);
    }
}
