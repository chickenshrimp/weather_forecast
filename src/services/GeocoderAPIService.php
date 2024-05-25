<?php

namespace App\services;

class GeocoderAPIService
{
    function sendRequest($address, $api_key)
    {
        $url = "https://geocode-maps.yandex.ru/1.x/".'?'.'apikey='.$api_key.'&geocode='.urlencode($address).'&format=json';
        $res = file_get_contents($url);
        $res = json_decode($res);
        $locations = $res->response->GeoObjectCollection->featureMember;

        return $locations;
    }
}