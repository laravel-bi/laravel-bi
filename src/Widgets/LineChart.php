<?php

namespace LaravelBi\LaravelBi\Widgets;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use LaravelBi\LaravelBi\Dashboard;
use LaravelBi\LaravelBi\Support\BiRequest;
use LaravelBi\LaravelBi\Dimensions\DateDimension;

class LineChart extends BaseWidget
{
    protected $component = 'line-chart';

    public function data(Dashboard $dashboard, BiRequest $request)
    {
        $data = parent::data($dashboard, $request);

        if ($this->dimensions->get(0) instanceof DateDimension) {
            return $this->adaptDataMissingDate($data, $request);
        }

        return $data;
    }

    private function adaptDataMissingDate($data, $request)
    {
        $dimension    = $this->dimensions->get(0);
        $dimensionKey = $dimension->key;

        $keyedData = $data->keyBy($dimension->key);

        if ($data->isEmpty()) {
            return $data;
        }

        $hasFilter = $request->hasFilter($dimensionKey);

        if ($hasFilter) {
            $dimensionFilter = $request->getFilter($dimensionKey);
            if (isset($dimensionFilter['start']) && isset($dimensionFilter['end'])) {
                $minDate         = Carbon::createFromFormat('Y-m-d', $dimensionFilter['start'])->{$dimension->carbonStartFunction}();
                $maxDate         = Carbon::createFromFormat('Y-m-d', $dimensionFilter['end'])->{$dimension->carbonEndFunction}();
            } else {
                $minDate = Carbon::createFromFormat($dimension->carbonFormat, $data->min($dimensionKey))->{$dimension->carbonStartFunction}();
                $maxDate = Carbon::createFromFormat($dimension->carbonFormat, $data->max($dimensionKey))->{$dimension->carbonEndFunction}();
            }
        } else {
            $minDate = Carbon::createFromFormat($dimension->carbonFormat, $data->min($dimensionKey))->{$dimension->carbonStartFunction}();
            $maxDate = Carbon::createFromFormat($dimension->carbonFormat, $data->max($dimensionKey))->{$dimension->carbonEndFunction}();
        }

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
