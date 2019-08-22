## Laravel Bi

Laravel Bi is a beautiful and fully-featured Business Intelligence dashboard manager for Laravel. It allow you to create dashboards only using your PHP classes.

### Main features

### Installation

### How to use

### Widgets

### Metrics

### Dimensions

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