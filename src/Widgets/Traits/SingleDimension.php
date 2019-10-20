<?php

namespace LaravelBi\LaravelBi\Widgets\Traits;

use LaravelBi\LaravelBi\Dimensions\Dimension;
use LaravelBi\LaravelBi\Support\AttributeCollection;

trait SingleDimension
{
    protected $dimension;
    protected $dimensions;

    public function dimension(Dimension $dimension): self
    {
        $this->dimension  = $dimension;
        $this->dimensions = new AttributeCollection([$this->dimension]);

        return $this;
    }
}
