<?php

namespace LaravelBi\LaravelBi\Widgets\Traits;

use LaravelBi\LaravelBi\Metrics\Metric;
use LaravelBi\LaravelBi\Dimensions\Dimension;
use LaravelBi\LaravelBi\Support\AttributeCollection;

trait HasAttributes
{
    protected $dimensions;
    protected $metrics;

    public function dimensions(array $dimensions): self
    {
        $this->dimensions = new AttributeCollection($dimensions);

        return $this;
    }

    public function dimension(Dimension $dimension): self
    {
        return $this->dimensions([$dimension]);
    }

    public function metrics(array $metrics): self
    {
        $this->metrics = new AttributeCollection($metrics);

        return $this;
    }

    public function metric(Metric $metric): self
    {
        return $this->metrics([$metric]);
    }

    protected function getAttributes()
    {
        return (new AttributeCollection($this->metrics))->merge($this->dimensions);
    }
}
