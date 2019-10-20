<?php

namespace LaravelBi\LaravelBi\Widgets;

use Illuminate\Http\Request;
use LaravelBi\LaravelBi\Dashboard;

class BigNumber extends BaseWidget
{
    protected $component = 'big-number';

    public function data(Dashboard $dashboard, Request $request)
    {
        $builder = $this->getBaseBuilder($dashboard);
        $builder = $this->applyAttributes($builder);
        $builder = $this->applyFilters($builder, $dashboard, $request);

        $rawModel = $builder->first();

        return $this->displayModel($rawModel)->toArray();
    }

    protected function extra()
    {
        return [
            'metric' => $this->metrics->get(0)
        ];
    }
}
