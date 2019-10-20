<?php

namespace LaravelBi\LaravelBi\Widgets;

class Table extends BaseWidget
{
    protected $component = 'table';

    // public function rawData(Dashboard $dashboard, Request $request): Collection
    // {
    //     $builder = $this->getBaseBuilder($dashboard, $request);
    //     $builder = collect($this->dimensions)->reduce(function ($builder, $dimension) {
    //         return $dimension->apply($builder, $this);
    //     }, $builder);
    //     $builder = collect($this->metrics)->reduce(function ($builder, $metric) {
    //         return $metric->apply($builder, $this);
    //     }, $builder);

    //     if ($request->has('sort')) {
    //         $dimension = $this->dimensions->getByKey($request->input('sort')['col']);
    //         if ($dimension) {
    //             $builder = $dimension->applySort($builder, $request->input('sort')['dir']);
    //         } else {
    //             $metric = $this->metrics->getByKey($request->input('sort')['col']);
    //             if ($metric) {
    //                 $builder = $metric->applySort($builder, $request->input('sort')['dir']);
    //             }
    //         }
    //     }

    //     return $builder->get();
    // }

    protected function extra()
    {
        return [
            'metrics'    => $this->metrics,
            'dimensions' => $this->dimensions
        ];
    }
}
