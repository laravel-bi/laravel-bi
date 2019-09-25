<?php

namespace LaravelBi\LaravelBi\Http\Controllers;

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
            'base' => config('bi.path')
        ];
    }
}
