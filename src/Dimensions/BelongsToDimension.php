<?php

namespace LaravelBi\LaravelBi\Dimensions;

use LaravelBi\LaravelBi\Widgets\Widget;
use Illuminate\Database\Eloquent\Builder;

class BelongsToDimension extends BaseDimension
{

    public $relation;

    public function __construct($key, $name)
    {
        parent::__construct($key, $name);
        $this->relation = $key;
    }

    public function relation($relation): self
    {
        $this->relation = $relation;

        return $this;
    }

    public function otherColumn($otherColumn): self
    {
        $this->otherColumn = $otherColumn;

        return $this;
    }

    public function apply(Builder $builder, Widget $widget): Builder
    {
        $method   = $this->relation;
        $relation = $builder->getModel()->$method();

        $table      = $relation->getRelated()->getTable();
        $parentKey  = $relation->getQualifiedOwnerKeyName();
        $foreignKey = $relation->getQualifiedForeignKeyName();

        return $builder->addSelect("$table.{$this->otherColumn} as {$this->key}")
                       ->join($table, $parentKey, '=', $foreignKey)
                       ->groupBy($this->key);
    }

}
