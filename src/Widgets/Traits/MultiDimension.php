<?php

namespace LaravelBi\LaravelBi\Widgets\Traits;

use LaravelBi\LaravelBi\Support\AttributeCollection;

trait MultiDimension
{
    protected $dimensions;

    public function dimensions(array $dimensions): self
    {
        $this->dimensions = new AttributeCollection($dimensions);

        return $this;
    }
}
