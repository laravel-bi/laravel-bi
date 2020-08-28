<?php

namespace LaravelBi\LaravelBi\Http\Controllers;

use Config;
use LaravelBi\LaravelBi\Support\BiRequest;

class HomepageController extends BaseController
{
    public function getIndex(BiRequest $request)
    {
        return redirect(route('bidashboard', ['dashboard' => $this->dashboardResolver->first()->uriKey]));
    }

    public function getDashboard(BiRequest $request)
    {
        return view('bi::index')
            ->with('serverData', $this->getServerData());
    }

    protected function getServerData()
    {
        return [
            'base' => Config::get('bi.path', 'bi')
        ];
    }
}
