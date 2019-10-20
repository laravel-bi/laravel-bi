<?php

namespace LaravelBi\LaravelBi\Support;

use Illuminate\Support\Collection;

class AttributeCollection extends Collection
{
    public function getByKey($key)
    {
        return $this->first(function ($field) use ($key) {
            return $field->key == $key;
        });
    }
}
