<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class BiServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->setupGate();
    }

    protected function setupGate()
    {
        Gate::define('viewBi', function ($user) {
            return true;
        });
    }

}
