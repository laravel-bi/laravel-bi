<?php

namespace LaravelBi\LaravelBi\Http\Controllers;

use Config;

class HomepageController extends BaseController
{
    public function getIndex()
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
