<?php

namespace LaravelBi\LaravelBi\Widgets;

use Illuminate\Http\Request;
use LaravelBi\LaravelBi\Dashboard;
use Illuminate\Database\Eloquent\Collection;

class Table extends BaseWidget
{

    protected $metrics;
    protected $dimensions;
    protected $component = 'table';

    public function metrics(array $metrics): self
    {
        $this->metrics = $metrics;

        return $this;
    }

    public function dimensions(array $dimensions): self
    {
        $this->dimensions = $dimensions;

        return $this;
    }

    // public function data(Dashboard $dashboard, Request $request)
    // {
    //     $rawData = $this->rawData($dashboard, $request);
    //     return collect($rawData)->map(function ($rawRow) {
    //         return collect($this->dimensions)->map(function ($dimension) use ($rawRow) {
    //             return $dimension->extract($rawRow[$dimension->key]);
    //         });
    //     });
    // }

    public function rawData(Dashboard $dashboard, Request $request): Collection
    {
        $builder = $this->getBaseBuilder($dashboard, $request);
        $builder = collect($this->dimensions)->reduce(function ($builder, $dimension) {
            return $dimension->apply($builder, $this);
        }, $builder);
        $builder = collect($this->metrics)->reduce(function ($builder, $metric) {
            return $metric->apply($builder, $this);
        }, $builder);
        if ($request->has('sort')) {
            $builder->orderBy($request->input('sort')['col'], $request->input('sort')['dir']);
        }

        return $builder->get();
    }

    protected function extra()
    {
        return [
            'metrics'    => $this->metrics,
            'dimensions' => $this->dimensions
        ];
    }
}
