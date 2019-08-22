<?php

namespace LaravelBi\LaravelBi\Dimensions;

use DB;
use Illuminate\Database\Eloquent\Builder;

class BelongsToDimension extends BaseDimension
{

    public $relationship;
    public $relationshipColumn;

    public function relationship($relationship, $column)
    {
        $this->relationship       = $relationship;
        $this->relationshipColumn = $column;
        return $this;
    }

    public function apply(Builder $builder, $widget)
    {
        $modelInstance        = new $widget->model();
        $relationshipInstance = $modelInstance->{$this->relationship}();
        $subQuery             = $relationshipInstance->getRelated()
                                                     ->getQuery()
                                                     ->select($this->relationshipColumn)
                                                     ->where($relationshipInstance->getQualifiedOwnerKeyName(), DB::raw($relationshipInstance->getQualifiedForeignKey()));
        return $builder->selectSub($subQuery, $this->key)
                       ->groupBy($this->key);
    }

}
