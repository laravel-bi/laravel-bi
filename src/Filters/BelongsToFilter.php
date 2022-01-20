<?php

namespace LaravelBi\LaravelBi\Filters;

use LaravelBi\LaravelBi\Dashboard;
use Illuminate\Database\Eloquent\Builder;
use LaravelBi\LaravelBi\Support\BiRequest;

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

    public function apply(Builder $builder, array $filterData, BiRequest $request): Builder
    {
        return $builder->whereIn($builder->getModel()->{$this->relation}()->getForeignKeyName(), $filterData);
    }

    public function extra(Dashboard $dashboard, BiRequest $request): array
    {
        return [
            'options'     => (new $dashboard->model())->{$this->relation}()->getRelated()->newQuery()->select('id', 'name')->get(),
            'otherColumn' => $this->otherColumn
        ];
    }
}
