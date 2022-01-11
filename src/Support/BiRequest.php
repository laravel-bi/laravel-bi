<?php

namespace LaravelBi\LaravelBi\Support;

use Illuminate\Http\Request;

class BiRequest
{
    private $originalRequest;

    public function __construct(Request $request)
    {
        $this->originalRequest = $request;
    }

    public function __call($method, $args)
    {
        return call_user_func_array([$this->originalRequest, $method], $args);
    }

    public function __get($prop)
    {
        return $this->originalRequest->$prop;
    }

    public function filters()
    {
        return $this->originalRequest->input('filters', []);
    }

    public function hasFilter($name)
    {
        return array_key_exists($name, $this->filters());
    }

    public function getFilter($name)
    {
        return $this->filters()[$name];
    }
}
