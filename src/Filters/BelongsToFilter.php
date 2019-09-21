<?php

namespace LaravelBi\LaravelBi\Filters;

use Illuminate\Http\Request;
use LaravelBi\LaravelBi\Dashboard;
use Illuminate\Database\Eloquent\Builder;

class BelongsToFilter extends BaseFilter
{

    private $relation;
    private $otherColumn;

    public $component = 'belongs-to';

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

    public function apply(Builder $builder, array $filterData, Request $request): Builder
    {
        return $builder->whereIn($builder->getModel()->{$this->relation}()->getForeignKey(), $filterData);
    }

    public function data(Dashboard $dashboard, Request $request)
    {
        return [
            'options'     => (new $dashboard->model())->{$this->relation}()->getRelated()->newQuery()->select('id', 'name')->get(),
            'otherColumn' => $this->otherColumn
        ];
    }

}
