<?php

namespace App\Controller;

use App\Apis\GeoLocation;
use App\services\WeatherAPIService;
use http\Env;
use mysql_xdevapi\Result;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\services\GeocoderAPIService;

class WeatherController extends AbstractController
{
    #[Route('/', methods: ['GET'])]
    public function index(Request $request)
    {
        if($request->query->get("place")){

            $location = $request->query->get("place");
            $yandexGeocoderApi = $this->getParameter('yandex.api.geocoder');
            $geocoder = new GeocoderAPIService();
            $json = $geocoder->sendRequest($location, $yandexGeocoderApi);
//            var_dump($json[0]->GeoObject->Point->pos); //выводится результат поиска

            $jsonWeather = $this->GetWeather($json[0]->GeoObject->Point->pos);

            return $this->render('index.html.twig', ['loca' => $location, 'weather' => $jsonWeather]);
        }

        return $this->render('index.html.twig');
    }

    private function GetWeather(string $coordinates)
    {
        $lonLan = explode(" ", $coordinates);
        $geoLocation = new GeoLocation();
        $geoLocation->Longitude = $lonLan[1];
        $geoLocation->Latitude = $lonLan[0];
        $yandexWeatherApi = $this->getParameter('yandex.api.key');
        $weatherGet = new WeatherAPIService();
        $json = $weatherGet->sendRequest($geoLocation, $yandexWeatherApi);
//        echo($json->fact->temp);

        return $json;

    }

    #[Route('/?place={place?}', methods: ['GET'])]
    public function GetGeoLocationByName($place)
    {
        $yandexGeocoderApi = $this->getParameter('yandex.api.geocoder');
        $geocoder = new GeocoderAPIService();
        $json = new JsonResponse($geocoder->sendRequest($place, $yandexGeocoderApi));
        var_dump($json);
        return $this->render('index.html.twig', [$json]);
    }

}