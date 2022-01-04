<?php

namespace App\Bi\Dashboards;

use App\Models\User;
use LaravelBi\LaravelBi\Dashboard;
use LaravelBi\LaravelBi\Widgets\BigNumber;
use LaravelBi\LaravelBi\Filters\DateFilter;
use LaravelBi\LaravelBi\Metrics\CountMetric;

class UserDashboard extends Dashboard
{

    public $model  = User::class;
    public $uriKey = 'users';
    public $name   = 'User dashboard';

    public function filters()
    {
        return [
            DateFilter::create('created_at', 'Created at')
        ];
    }

    public function widgets()
    {
        return [
            BigNumber::create('user-count', 'Registered users')
                ->metric(
                    CountMetric::create('count', 'Count')
                        ->color('#ff5555')
                )
                ->width('1/3')
        ];
    }
}
