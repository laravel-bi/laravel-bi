<?php

namespace LaravelBi\LaravelBi\Tests\Models;

use Illuminate\Database\Eloquent\Model;

class FooModel extends Model
{
    protected $table = 'foo';

    public function bar()
    {
        return $this->belongsTo(BarModel::class, 'bar_id');
    }
}
