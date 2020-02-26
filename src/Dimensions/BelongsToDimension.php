<?php

namespace LaravelBi\LaravelBi\Dimensions;

use Illuminate\Database\Eloquent\Model;
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
        $foreignKey = $this->getForeignKey($builder);

        return $builder->addSelect($foreignKey)
                       ->with($this->relation)
                       ->groupBy($foreignKey);
    }

    public function applySort(Builder $builder, string $dir): Builder
    {
        $foreignKey = $this->getForeignKey($builder);

        return $builder->orderBy($foreignKey, $dir);
    }

    public function display(Model $model, array $models)
    {
        $value = $model->{$this->relation}->{$this->otherColumn};
        $model->unsetRelation($this->relation);

        return $value;
    }

    private function getForeignKey(Builder $builder)
    {
        $method   = $this->relation;
        $relation = $builder->getModel()->$method();

        return method_exists($relation, 'getForeignKey') ? $relation->getForeignKey() : $relation->getForeignKeyName();
    }
}
