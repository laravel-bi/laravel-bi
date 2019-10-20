<?php

namespace LaravelBi\LaravelBi\Widgets;

class LineChart extends BaseWidget
{
    protected $component = 'line-chart';

    protected function extra()
    {
        return [
            'metrics'   => $this->metrics,
            'dimension' => $this->dimensions->get(0)
        ];
    }
}
