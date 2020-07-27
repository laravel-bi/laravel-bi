<?php

namespace LaravelBi\LaravelBi\Widgets;

class PartitionPie extends BaseWidget
{
    protected $component = 'partition-pie';

    protected $colors;

    public function colors(array $colors): self
    {
        $this->colors = $colors;

        return $this;
    }

    protected function extra(): array
    {
        return [
            'colors'    => $this->colors
        ];
    }
}
