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
        return call_user_func_array(array($this->originalRequest, $method), $args);
    }

    public function __get($prop)
    {
        return $this->originalRequest->$prop;
    }

}
