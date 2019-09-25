<?php

namespace LaravelBi\LaravelBi\Http\Controllers;

use LaravelBi\LaravelBi\DashboardResolver;

abstract class BaseController
{
    protected $dashboardResolver;

    public function __construct(DashboardResolver $dashboardResolver)
    {
        $this->dashboardResolver = $dashboardResolver;
    }
}
