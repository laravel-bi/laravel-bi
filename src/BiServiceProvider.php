<?php

namespace LaravelBi\LaravelBi;

use Route;
use Illuminate\Support\ServiceProvider;

class BiServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->registerPublishing();
        }

        $this->registerViews();
        $this->registerRoutes();
        $this->setUpRouteModelBinding();
    }

    protected function registerPublishing()
    {
        $this->publishes([
            __DIR__ . '/../config/bi.php' => config_path('bi.php')
        ], 'bi-config');

        $this->publishes([
            __DIR__ . '/../public' => public_path('vendor/bi')
        ], 'bi-assets');
    }

    protected function registerViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'bi');
    }

    protected function registerRoutes()
    {
        Route::group([
            'namespace'  => 'LaravelBi\LaravelBi\Http\Controllers',
            'as'         => 'bi',
            'prefix'     => config('bi.path', 'bi'),
            'middleware' => 'web'
        ], function () {
            Route::group([
                'namespace' => 'Apis',
                'as'        => 'bi.api',
                'prefix'    => '/bi-apis'
            ], function () {
                $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
            });
            $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        });
    }

    protected function setUpRouteModelBinding()
    {
        Route::bind('dashboard', function ($value) {
            return resolve(DashboardResolver::class)->find($value) ?? abort(404);
        });
    }
}
