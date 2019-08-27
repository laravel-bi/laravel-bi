<?php

namespace LaravelBi\LaravelBi;

abstract class Dashboard implements \JsonSerializable
{

    abstract public function widgets();
    abstract public function filters();

    public function findWidgetOrFail($widgetKey)
    {
        $widget = collect($this->widgets())->first(function ($widget) use ($widgetKey) {
            return $widget->key == $widgetKey;
        });

        if(!$widget) {
            abort(404);
        }

        return $widget;
    }

    public function jsonSerialize()
    {
        return [
            'uriKey'  => $this->uriKey,
            'name'    => $this->name,
            'widgets' => $this->widgets(),
            'filters' => $this->filters()
        ];
    }

}
