## Laravel Bi

Laravel Bi is a beautiful and fully-featured Business Intelligence dashboard manager for Laravel.

[![Build Status](https://travis-ci.org/laravel-bi/laravel-bi.svg?branch=master)](https://travis-ci.org/laravel-bi/laravel-bi)
[![StyleCI](https://github.styleci.io/repos/203451164/shield?branch=master)](https://github.styleci.io/repos/203451164)

### Main features and concept

Laravel-Bi uses `dashboards` to show data to the users. Each dashboard contains `widgets`. Each widget presents data to your user using different tool. Each widget's `metrics` and `dimensions` are fully customizable.

For now, it works only with mysql databases.

### Attributes

Attributes are common representation of Dimension and Metric. You can instantiate Attribute using `create` static method. It accept 2 parameters:

- key: a mandatory internal identifier
- name: a mandatory label

```php
StringDimension::create('name', 'The Name');
SumMetric::create('unique_name_for_some_of_prices', 'The Sum');
```

Some extra methods are available:

- `column($columnName)` to set a custom database column name (defaulted to key)
- `color($color)` to set a custom color for the attribute (it will be used in charts)

You can chain all these methods:

```php
SumMetric::create('unique_name_for_some_of_prices', 'The Sum')
    ->column('price_column')
    ->color('#FF0000');
```

#### Dimensions

Dimensions are attributes of your data. Laravel-Bi is shipped with some preconfigured dimensions:

##### `StringDimension`

It represents a string column. No transformation or logic are applied. It comes to your widget as it is saved in your database.

##### `YearDimension`

It represents a year. It applies a `DATE_FORMAT` clause to your database query in order to take only year digits. Its default format is `%Y` (e.g. _2019_).

##### `MonthDimension`

It represents a month. It applies a `DATE_FORMAT` clause to your database query in order to take only year and month digits. Its default format is `%Y-%m` (e.g. _2019-01_).

##### `DayDimension`

It represents a day. It applies a `DATE_FORMAT` clause to your database query in order to take only year, month and day digits. Its default format is `%Y-%m-%d`  (e.g. _2019-01-15_).

##### `DateDimension`

It represents a date. It allows to set a custom `DATE_FORMAT` clause using `format()` method.

It has a one custom method:

- `format($format)` to set a custom DATE_FORMAT format. 

```php
DateDimension::create('year_week', 'Year Week')
    ->format('%Y-%u');
```

##### `BelongsToDimension`

It represents a string value taken from a BelongsTo relationship. It comes from a JOIN clause in order to use it in filters or in sorting.

It has a two custom methods:

- `relation($relationName)` to set a eloquent relation name
- `otherColumn($columnName)` to set the related object column

```php
BelongsToDimension::create('product_name', 'Product')
    ->relation('product')
    ->otherColumn('name');
```

##### `RawDimension`

It represents a raw dimension you can edit as you want using `raw` method.

It has a one custom method:

- `raw($rawClause)` to set a custom raw clause

```php
DateDimension::create('initial_of_name', 'Initial')
    ->raw('LEFT(name, 1)');
```

##### Create your Custom dimensions

You can easily use them in your widgets or create your custom dimensions. Please take a look to the existing dimensions.

#### Metrics

Metrics are quantitative measurements. Laravel-Bi is shipped with some preconfigured metrics:

##### `CountMetric`

It is a simple metric that count number of records. This is not related to a particular column.

##### `SumMetric`

It sums a particular column values.

##### `AverageMetric`

It calculate average of a particular column values.

##### `RawMetric`

It represents a raw metric you can edit as you want using `raw` method.

It has a one custom method:

- `raw($rawClause)` to set a custom raw clause

```php
DateDimension::create('discounted_price', 'Discounted Price')
    ->raw('price * 0.9');
```

##### Custom metrics

You can easily use them in your widgets or create your custom dimensions. Please take a look to the existing metrics.

#### Widgets

Widgets are graphical representation of your data that use Dimensions and Metrics to gather information. You can instantiate Widgets using `create` static method. It accept 2 parameters:

- key: a mandatory internal identifier
- name: a mandatory label

```php
BigNumber::create('order_number', 'Orders')
```

You can attach attributes to a widget using:

- `dimensions($dimensions)` to set an array of dimensions
- `dimension($dimension)` to set a single dimension
- `metrics($metrics)` to set an array of metrics
- `metric($metric)` to set a single metric

```php
Table::create('table', 'Table')
    ->dimension([
        BelongsToDimension::create('product', 'Product')
            ->relation('product')
            ->otherColumn('name');
    ])
    ->metrics([
        SumMetric::create('price', 'Revenues')
    ]);
```

Some extra methods are available:

- `width($widthClass)` to set a custom width (it should be a Tailwind CSS `w-` class)
- `scope($closuer)` to set a particular scope for a widget

You can chain all these methods:

```php
BigNumber::create('order_number_with_price_greater_than_10', 'Big Orders')
    ->width('w-1/2')
    ->scope(function(Builder $builder) {
        return $builder->where('price', '>', 10);
    });
```

Laravel-Bi is shippend with some preconfigured widgets:

##### `BigNumber`

It shows a particular and relevant metric as a KPI. It accept a single metric.

##### `Table`

It shows some dimensions and metrics organized in a table allowing user to apply a custom sorting. It accept multiple dimensions and metrics.

##### `LineChart`

It shows a line chart with different axis on a single horizontal dimension. It accept a single dimension and multiple metrics.

##### `PartitionPie`

It shows a pie chart with a single metric and a single dimension. It accept a single dimension and a single metric.

#### Filters

Filters are special tools that allow users to filter data in each dashboard. Laravel-Bi is shippend with some preconfigured filters:

*TODO*

### Usage

#### Installation

Download package using composer:

```shell
composer require laravel-bi/laravel-bi
```

#### Dashboard creation

Run this artisan command to create an empty dashboard

```shell
php artisan bi:dashboard ExampleDashboard
```

#### Dashboard configuration

Each dashboard presents 2 method: `filters()` and `widgets()` and 3 properties `model`, `uriKey`, `name`. 
You have to implement methods returning respectively a list of filters and a list of widget.

```php
public function widgets()
{
    return [
        BigNumber::create('post-count', 'Number of Posts')
            ->metric(CountMetric::create('count', 'Count'))
            ->width('w-1/2')
    ];
}
```

#### Dashboard configuration

Thanks to https://github.com/sschoger/heroicons-ui


