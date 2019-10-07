<?php

namespace LaravelBi\LaravelBi\Dimensions;

use DB;
use LaravelBi\LaravelBi\Widgets\Widget;
use Illuminate\Database\Eloquent\Builder;

class RawDimension extends BaseDimension
{

    private $raw;

    public function apply(Builder $builder, Widget $widget): Builder
    {
        return $builder->addSelect(DB::raw("{$this->raw} as `{$this->key}`"))
                       ->groupBy($this->key);
    }

    public function raw($raw)
    {
        $this->raw = $raw;
        return $this;
    }
}
