<?php

namespace LaravelBi\LaravelBi\Dimensions;


use LaravelBi\LaravelBi\Widgets\Widget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DateDimension extends BaseDimension
{
    private $sqlFormat;
    public $carbonFormat;
    public $carbonInterval;

    // public function __construct(string $key, string $name)
    // {
    //     $this->key    = 'formatted_' . $key;
    //     $this->name   = $name;
    //     $this->column = $key;
    // }

    public function apply(Builder $builder, Widget $widget): Builder
    {
        return $builder->addSelect(DB::raw("DATE_FORMAT({$this->column}, '{$this->sqlFormat}') as `{$this->key}`"))
                       ->groupBy($this->key);
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

    public function display(Model $value, array $models)
    {        
        return $value->getRawOriginal($this->key);
    }
}
