## Laravel Bi

Laravel Bi is a beautiful and fully-featured Business Intelligence dashboard manager for Laravel.

[![Build Status](https://travis-ci.org/laravel-bi/laravel-bi.svg?branch=master)](https://travis-ci.org/laravel-bi/laravel-bi)
[![StyleCI](https://github.styleci.io/repos/203451164/shield?branch=master)](https://github.styleci.io/repos/203451164)

### Main features

Laravel-Bi uses `dashboards` to show data to the users. Each dashboard contains `widgets`. Each widget presents data to your user using different tool. Each widget's `metrics` and `dimensions` are fully customizable.

### Main concepts

#### Dimensions

Dimensions are attributes of your data. Laravel-Bi is shipped with some preconfigured dimensions:

##### `StringDimension`

It represents a string column. No transformation or logic are applied. It comes to your widget as it is saved in your database.

##### `YearDimension`

It represents a year. It applies a `DATE_FORMAT` clause to your database format in order to take only year digits. Its default format is `%Y` (e.g. _2019_).

##### `MonthDimension`

It represents a month. It applies a `DATE_FORMAT` clause to your database format in order to take only year and month digits. Its default format is `%Y-%m` (e.g. _2019-01_).

##### `DayDimension`

It represents a day. It applies a `DATE_FORMAT` clause to your database format in order to take only year, month and day digits. Its default format is `%Y-%m-%d`  (e.g. _2019-01-15_).

##### `DateDimension`

It represents a day. It allows to set a custom `DATE_FORMAT` clause using `format()` method.

##### `BelongsToDimension`

It represents a string value taken from a BelongsTo relationship. It comes from a JOIN clause in order to use it in filters or in sorting.

##### `RawDimension`

It represents a raw dimension you can edit as you want using `raw` method.

##### Custom dimensions

You can easily use them in your widgets or create your custom dimensions.

#### Metrics

Metrics are quantitative measurements. Laravel-Bi is shipped with some preconfigured metrics:

##### `CountMetric`

It is a simple metric that count number of records. This is not related to a particular column.

##### `SumMetric`

It sums a particular column values.

##### `AverageMetric`

It calculate average of a particular column values.

##### Custom metrics

You can easily use them in your widgets or create your custom dimensions.

#### Widgets

Widgets are graphical representation of your data that use Dimensions and Metrics to gather information. Each widget has a different configuration. Laravel-Bi is shippend with some preconfigured widgets:

##### `BigNumber`

It shows a particular and relevant metric as a KPI.

##### `Table`

It shows some dimensions and metrics organized in a table allowing user to apply a custom sorting.

##### `LineChart`

It shows a line chart with different axis on a single horizontal dimension.

##### `PartitionPie`

It shows a pie chart with a single metric and a single dimension.

#### Filters

Filters are special tools that allow users to filter data in each dashboard. Laravel-Bi is shippend with some preconfigured filters:

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

Each dashboard presents 2 method: `filters()` and `widgets()`. You have to implement them returning respectively a list of filters and a list of widget.

```php
public function widgets()
{
    return [
        BigNumber::create('blog-post-count', 'Number of Blog Posts')
            ->metric(CountMetric::create())
            ->model(BlogPost::class)
            ->width(0.5)
    ];
}
```