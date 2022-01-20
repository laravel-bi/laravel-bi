<?php

namespace LaravelBi\LaravelBi\Http\Controllers\Apis;

use Illuminate\Support\Str;
use LaravelBi\LaravelBi\Dashboard;
use LaravelBi\LaravelBi\Support\BiRequest;
use LaravelBi\LaravelBi\Http\Controllers\BaseController;

class WidgetController extends BaseController
{
    public function getWidget(Dashboard $dashboard, $widgetKey, BiRequest $request)
    {
        $widget = $dashboard->findWidgetOrFail($widgetKey);

        return [
            'status' => 200,
            'data'   => $widget->data($dashboard, $request)
        ];
    }

    public function download(Dashboard $dashboard, $widgetKey, BiRequest $request)
    {
        $widget = $dashboard->findWidgetOrFail($widgetKey);

        $data = $widget->data($dashboard, $request);

        $headers = [
            'Content-type'        => 'text/plain',
            'Pragma'              => 'no-cache',
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Expires'             => '0',
            'Content-Disposition' => 'attachment; filename=' . Str::slug($widget->name) . '.csv'
        ];

        return response()->stream(function () use ($data) {
            $file = fopen('php://output', 'w');

            fputcsv($file, array_keys(get_object_vars($data[0])));

            foreach ($data as $row) {
                fputcsv($file, get_object_vars($row));
            }

            fclose($file);
        }, 200, $headers);
    }
}
