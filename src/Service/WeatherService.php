<?php

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;

/**
 * Service to manage Weather Forecast for Cities.
 */
class WeatherService
{
    /**
     * get list of Cities from Musement API
     * 
     * @return array<mixed>
     */
    public function getCities()
    {
        $client = HttpClient::create();
        $response = $client->request('GET', 'https://sandbox.musement.com/api/v3/cities', [
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);

        return $response->toArray();
    }

    /**
     * get Weather Forecast for specific latitude and longitude
     * 
     * @param float $latitude
     * @param float $longitude
     * @param int $days
     * @return array<mixed>
     */
    public function getWeather(float $latitude, float $longitude, int $days)
    {
        $client = HttpClient::create();
        $response = $client->request('GET', 'https://api.weatherapi.com/v1/forecast.json?key=da9e96b00aa94fdfa48142125220601&q='.$latitude.','.$longitude.'&days='.$days);

        return $response->toArray();
    }
}
