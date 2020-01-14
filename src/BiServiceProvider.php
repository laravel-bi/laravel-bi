<?php

namespace LaravelBi\LaravelBi;

use App;
use Route;
use Config;
use Illuminate\Support\ServiceProvider;

class BiServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->registerPublishing();
        }

        $this->setUpRouteModelBinding();

        $this->registerViews();
        $this->registerRoutes();
        $this->registerCommands();
    }

    protected function registerPublishing()
    {
        $this->publishes([
            __DIR__ . '/../stubs/service-provider.stub' => app_path('Providers/BiServiceProvider.php')
        ], 'bi-provider');

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
            'prefix'     => Config::get('bi.path', 'bi'),
            'middleware' => 'web'
        ], function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        });
        Route::group([
            'namespace'  => 'LaravelBi\LaravelBi\Http\Controllers\Apis',
            'as'         => 'bi.api',
            'prefix'     => Config::get('bi.path', 'bi') . '-apis',
            'middleware' => 'web'
        ], function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        });
    }

    protected function registerCommands()
    {
        $this->commands([
            Console\DashboardCommand::class,
            Console\InstallCommand::class
        ]);
    }

    protected function setUpRouteModelBinding()
    {
        Route::bind('dashboard', function ($value) {
            return App::make(DashboardResolver::class)->find($value) ?? abort(404);
        });
    }
}
