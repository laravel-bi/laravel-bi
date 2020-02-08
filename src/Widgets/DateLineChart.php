<?php

namespace LaravelBi\LaravelBi\Widgets;

use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use LaravelBi\LaravelBi\Dashboard;

class DateLineChart extends LineChart
{
    public function data(Dashboard $dashboard, Request $request)
    {
        $data = parent::data($dashboard, $request);

        return $this->adaptDataMissingDate($data, $request);
    }

    private function adaptDataMissingDate($data, Request $request)
    {
        $requestedFilters = $request->input('filters');
        $dimensionColumn  = $this->dimensions->get(0)->column;
        $dimensionKey     = $this->dimensions->get(0)->key;

        if (!$requestedFilters || !array_key_exists($dimensionColumn, $requestedFilters)) {
            return $data;
        }

        $dateFilter = $requestedFilters[$dimensionColumn];

        $period = CarbonPeriod::create($dateFilter['start'], $dateFilter['end']);

        $adaptedData = collect();
        $keyedData   = $data->keyBy($dimensionKey);

        foreach ($period as $date) {
            $dateString = $date->format('Y-m-d');
            if ($keyedData->has($dateString)) {
                $adaptedData->push($keyedData->get($dateString));
            } else {
                $fakeItem                = [];
                $fakeItem[$dimensionKey] = $dateString;
                foreach ($this->metrics as $metric) {
                    $fakeItem[$metric->key] = $metric->getEmptyValue();
                }
                $adaptedData->push($fakeItem);
            }
        }

        return $adaptedData;
    }
}
