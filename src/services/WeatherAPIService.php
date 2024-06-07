<?php

namespace App\services;

use App\Apis\GeoLocation;

class WeatherAPIService
{
    public array $CONDITIONS = [
        'clear' => 'Ясно',
        'partly-cloudy' => 'Малооблачно',
        'cloudy' => 'Облачно с прояснениями',
        'overcast' => 'Пасмурно',
        'light-rain' => 'Небольшой дождь',
        'rain' => 'Дождь',
        'heavy-rain' => 'Сильный дождь',
        'showers' => 'Ливень',
        'wet-snow' => 'Дождь со снегом',
        'light-snow' => 'Небольшой снег',
        'snow' => 'Снег',
        'snow-showers' => 'Снегопад',
        'hail' => 'Град',
        'thunderstorm' => 'Гроза',
        'thunderstorm-with-rain' => 'Дождь с грозой',
        'thunderstorm-with-hail' => 'Гроза с градом'
    ];
    function sendRequest(GeoLocation $coordinates, $api_key)
    {
        $opts = ['http'=>['method' => 'GET',
            'header' => 'X-Yandex-Weather-Key: '. $api_key]];
        $context = stream_context_create($opts);
        $weather=file_get_contents
        ("https://api.weather.yandex.ru/v2/forecast?lat=".$coordinates->Longitude ."&lon="
            .$coordinates->Latitude,false,$context);

        $weather = json_decode($weather);


        foreach ($this->CONDITIONS as $key => $value) {

            if (str_contains($key, $weather->fact->condition)) {
                $weather->fact->condition = $value;
            }
            if (str_contains($key, $weather->forecasts[1]->parts->day->condition)) {
                $weather->forecasts[1]->parts->day->condition = $value;
            }
        }
        return $weather;
    }
}