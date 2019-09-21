<?php

namespace LaravelBi\LaravelBi\Http\Controllers\Apis;

use Response;
use Illuminate\Http\Request;
use LaravelBi\LaravelBi\Dashboard;
use LaravelBi\LaravelBi\Http\Controllers\BaseController;

class WidgetController extends BaseController
{

    public function getWidget(Dashboard $dashboard, $widget, Request $request)
    {
        $widget = $dashboard->findWidgetOrFail($widget);

        return [
            'status' => 200,
            'data'   => $widget->data($dashboard, $request)
        ];
    }

    public function download(Dashboard $dashboard, $widget, Request $request)
    {
        $widget = $dashboard->findWidgetOrFail($widget);

        $data = $widget->data($dashboard, $request);

        $headers = [
            'Content-type'        => 'text/plain',
            'Pragma'              => 'no-cache',
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Expires'             => '0',
            'Content-Disposition' => 'attachment; filename=' . str_slug($widget->name) . '.csv'
        ];

        return Response::stream(function () use ($data) {
            $file = fopen('php://output', 'w');
            $data->each(function ($row) use ($file) {
                fputcsv($file, $row->toArray());
            });
            fclose($file);
        }, 200, $headers);
    }

}
