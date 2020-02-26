<?php

namespace LaravelBi\LaravelBi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Attribute
{
    public $key;
    public $name;
    public $column;
    public $color;

    public function __construct(string $key, string $name)
    {
        $this->key    = $key;
        $this->name   = $name;
        $this->column = $key;
    }

    public static function create(string $key, string $name): self
    {
        return new static($key, $name);
    }

    public function column(string $column): self
    {
        $this->column = $column;

        return $this;
    }

    public function color($color): self
    {
        $this->color = $color;

        return $this;
    }

    public function display(Model $value, array $models)
    {
        return $value->{$this->key};
    }

    public function applySort(Builder $builder, string $dir): Builder
    {
        return $builder->orderBy($this->key, $dir);
    }
}
