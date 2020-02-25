<?php

namespace LaravelBi\LaravelBi\Widgets;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use LaravelBi\LaravelBi\Dashboard;

class DateLineChart extends LineChart
{
    public function data(Dashboard $dashboard, Request $request)
    {
        $data = parent::data($dashboard, $request);

        return $this->adaptDataMissingDate($dashboard, $data, $request);
    }

    private function adaptDataMissingDate(Dashboard $dashboard, $data, Request $request)
    {
        $dimension        = $this->dimensions->get(0);
        $requestedFilters = $request->input('filters');
        $dimensionColumn  = $dimension->column;
        $dimensionKey     = $this->dimensions->get(0)->key;

        $methods = [
            'startOf' . ucfirst($dimension->carbonInterval),
            'endOf' . ucfirst($dimension->carbonInterval)
        ];

        if ($requestedFilters && array_key_exists($dimensionColumn, $requestedFilters)) {    
            $dateLimits = [
                'start' => Carbon::createFromFormat('Y-m-d', $requestedFilters[$dimensionColumn]['start'])->{$methods[0]}(),
                'end'   => Carbon::createFromFormat('Y-m-d', $requestedFilters[$dimensionColumn]['end'])->{$methods[1]}()
            ];
        } else {
            $dateLimits = [
                'start' => Carbon::createFromFormat($dimension->carbonFormat, $data->first()[$dimensionKey])->{$methods[0]}(),
                'end'   => Carbon::createFromFormat($dimension->carbonFormat, $data->last()[$dimensionKey])->{$methods[1]}()
            ];
        }

        $period = CarbonPeriod::create($dateLimits['start'], "1 " . $dimension->carbonInterval, $dateLimits['end']);

        $adaptedData = collect();
        $keyedData   = $data->keyBy($dimensionKey);

        foreach ($period as $date) {
            $dateString = $date->format($dimension->carbonFormat);
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
