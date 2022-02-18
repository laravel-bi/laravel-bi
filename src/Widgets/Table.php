<?php

namespace LaravelBi\LaravelBi\Widgets;

use LaravelBi\LaravelBi\Dashboard;
use LaravelBi\LaravelBi\Support\BiRequest;

class Table extends BaseWidget
{
    protected $component = 'table';
    public $orderByColumn;
    public $orderByDir;

    public function orderBy($column, $dir = 'asc'): self
    {
        $this->orderByColumn = $column;
        $this->orderByDir    = $dir;

        return $this;
    }

    public function data(Dashboard $dashboard, BiRequest $request)
    {
        $builder = $this->getBaseBuilder($dashboard);
        $builder = $this->applyAttributes($builder);
        $builder = $this->applyFilters($builder, $dashboard, $request);

        if ($request->has('sort')) {
            $dimension = $this->dimensions->getByKey($request->input('sort')['col']);
            if ($dimension) {
                $builder = $dimension->applySort($builder, $request->input('sort')['dir']);
            } else {
                $metric = $this->metrics->getByKey($request->input('sort')['col']);
                if ($metric) {
                    $builder = $metric->applySort($builder, $request->input('sort')['dir']);
                }
            }
        }

        $rawModels      = $builder->get();
        $rawModelsArray = $rawModels->toArray();

        return $rawModels->map(function ($rawModel) use ($rawModelsArray) {
            return $this->displayModel($rawModel, $rawModelsArray);
        });
    }

    protected function extra(): array
    {
        return [
            'orderBy' => [
                'col' => $this->orderByColumn,
                'dir' => $this->orderByDir
            ]
        ];
    }
}
