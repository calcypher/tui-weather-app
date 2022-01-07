<?php

namespace App\Service;

use App\Dto\City;
use App\Dto\Weather;
use Symfony\Component\HttpClient\HttpClient;

/**
 * Service to manage Weather Forecast for Cities.
 */
class WeatherService
{
    /**
     * get list of Cities from Musement API.
     *
     * @return array<City>
     */
    public function getCities()
    {
        $cities = [];
        $client = HttpClient::create();
        $response = $client->request('GET', 'https://sandbox.musement.com/api/v3/cities', [
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);

        $cityItems = $response->toArray();
        foreach ($cityItems as $cityItem) {
            $city = new City();
            $city->setName($cityItem['name']);
            $city->setLatitude($cityItem['latitude']);
            $city->setLongitude($cityItem['longitude']);
            $cities[] = $city;
        }

        return $cities;
    }

    /**
     * get Weather Forecast for specific latitude and longitude.
     *
     * @return array<Weather>
     */
    public function getWeather(float $latitude, float $longitude, int $days)
    {
        $client = HttpClient::create();
        $response = $client->request('GET', 'https://api.weatherapi.com/v1/forecast.json?key=da9e96b00aa94fdfa48142125220601&q='.$latitude.','.$longitude.'&days='.$days);

        $weathers = [];
        $days = $response->toArray();
        foreach ($days['forecast']['forecastday'] as $day) {
            $weather = new Weather();
            $weather->setDay($day['date']);
            $weather->setCondition($day['day']['condition']['text']);
            $weathers[] = $weather;
        }

        return $weathers;
    }
}
