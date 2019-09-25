<?php

namespace LaravelBi\LaravelBi\Tests\Dimensions;

use Orchestra\Testbench\TestCase;
use Illuminate\Database\Eloquent\Builder;
use LaravelBi\LaravelBi\Widgets\BigNumber;
use LaravelBi\LaravelBi\Dimensions\Dimension;
use LaravelBi\LaravelBi\Tests\Models\FooModel;

abstract class AbstractDimensionTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->baseBuilder = FooModel::query();
    }

    public function test_query_builder(): void
    {
        $dimension = $this->buildDimension();
        $builder   = $dimension->apply($this->baseBuilder, BigNumber::create('test', 'Test'));
        $this->assertSql($builder, $this->getQuery());
    }

    protected function assertSql(Builder $builder, $query): void
    {
        $this->assertEquals($builder->toSql(), $query);
    }

    abstract protected function buildDimension(): Dimension;

    abstract protected function getQuery(): string;
}
