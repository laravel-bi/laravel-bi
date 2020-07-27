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

        return $this->adaptDataMissingDate($data);
    }

    private function adaptDataMissingDate($data)
    {
        $dimension    = $this->dimensions->get(0);
        $dimensionKey = $dimension->key;

        $keyedData = $data->keyBy($dimension->key);

        if($data->isEmpty()) return $data;

        $minDate = Carbon::createFromFormat($dimension->carbonFormat, $data->min($dimensionKey))->startOfDay();
        $maxDate = Carbon::createFromFormat($dimension->carbonFormat, $data->max($dimensionKey))->startOfDay();

        $period = CarbonPeriod::create($minDate, '1 ' . $dimension->carbonInterval, $maxDate);

        $adaptedData = collect();
        $keyedData   = $data->keyBy($dimensionKey);

        foreach ($period as $date) {
            $dateString = $date->format($dimension->carbonFormat);
            if ($keyedData->has($dateString)) {
                $adaptedData->push($keyedData->get($dateString));
            } else {
                $fakeItem = [];
                foreach ($this->metrics as $metric) {
                    $fakeItem[$metric->key] = $metric->getEmptyValue();
                }
                $fakeItem[$dimensionKey] = $dateString;
                $adaptedData->push($fakeItem);
            }
        }

        return $adaptedData;
    }
}
