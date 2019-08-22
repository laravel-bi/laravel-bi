<?php

namespace LaravelBi\LaravelBi;

abstract class Dashboard
{

    abstract public function uriKey();
    abstract public function name();

    abstract public function widgets();

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

    public function toArray()
    {
        return [
            'uriKey'  => $this->uriKey(),
            'name'    => $this->name(),
            'widgets' => $this->widgets()
        ];
    }

}
