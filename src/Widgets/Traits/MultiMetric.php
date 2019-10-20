<?php

namespace LaravelBi\LaravelBi\Widgets\Traits;

use LaravelBi\LaravelBi\Support\AttributeCollection;

trait MultiMetric
{
    protected $metrics;

    public function metrics(array $metrics): self
    {
        $this->metrics = new AttributeCollection($metrics);

        return $this;
    }
}
