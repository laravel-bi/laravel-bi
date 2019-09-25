<?php

namespace LaravelBi\LaravelBi;

class DashboardResolver
{
    private $dashboards;

    public function __construct()
    {
        $this->dashboards = collect();
        foreach (config('bi.dashboards', []) as $dashboardClass) {
            $dashboard = resolve($dashboardClass);
            $this->dashboards->put($dashboard->uriKey, $dashboard);
        }
    }

    public function find($dashboardUriKey)
    {
        return $this->dashboards->get($dashboardUriKey);
    }

    public function all()
    {
        return $this->dashboards;
    }
}
