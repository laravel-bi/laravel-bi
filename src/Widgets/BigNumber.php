<?php

namespace LaravelBi\LaravelBi\Widgets;

use LaravelBi\LaravelBi\Dashboard;
use LaravelBi\LaravelBi\Support\BiRequest;

class BigNumber extends BaseWidget
{
    protected $component = 'big-number';

    public function data(Dashboard $dashboard, BiRequest $request)
    {
        $builder = $this->getBaseBuilder($dashboard);
        $builder = $this->applyAttributes($builder);
        $builder = $this->applyFilters($builder, $dashboard, $request);

        $rawModels      = $builder->get();
        $rawModelsArray = $rawModels->toArray();

        return $rawModels->map(function ($rawModel) use ($rawModelsArray) {
            return $this->displayModel($rawModel, $rawModelsArray);
        });
    }
}
