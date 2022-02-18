<?php

namespace LaravelBi\LaravelBi\Dimensions;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use LaravelBi\LaravelBi\Widgets\Widget;
use Illuminate\Database\Eloquent\Builder;

class DateDimension extends BaseDimension
{
    private $sqlFormat;
    public $carbonFormat;
    public $carbonInterval;
    public $carbonStartFunction;
    public $carbonEndFunction;

    public function apply(Builder $builder, Widget $widget): Builder
    {
        return $builder->addSelect(DB::raw("DATE_FORMAT({$this->column}, '{$this->sqlFormat}') as `{$this->key}`"))
                       ->groupBy(DB::raw("DATE_FORMAT({$this->column}, '{$this->sqlFormat}')"));
    }

    public function sqlFormat($sqlFormat)
    {
        $this->sqlFormat = $sqlFormat;

        return $this;
    }

    public function carbonFormat($carbonFormat, $carbonInterval)
    {
        $this->carbonFormat   = $carbonFormat;
        $this->carbonInterval = $carbonInterval;

        return $this;
    }

    public function carbonFunctions($start, $end)
    {
        $this->carbonStartFunction = $start;
        $this->carbonEndFunction   = $end;

        return $this;
    }

    public function display(Model $value, array $models)
    {
        return $value->getRawOriginal($this->key);
    }
}
