<?php

namespace Tests\App\Service;

use App\Dto\City;
use App\Dto\Weather;
use App\Service\WeatherService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class WeatherServiceTest extends WebTestCase
{
    public function testGetCities()
    {
        $weatherService = new WeatherService();
        $cities = $weatherService->getCities();

        $this->assertIsArray($cities);

        foreach ($cities as $city) {
            $this->assertInstanceOf(City::class, $city);
            // test only one item
            break;
        }
    }

    public function testGetWeather()
    {
        $weatherService = new WeatherService();

        // Amsterdam
        $latitude = 52.37;
        $longitude = 4.9;
        $days = 2;

        $weathers = $weatherService->getWeather($latitude, $longitude, $days);

        $this->assertIsArray($weathers);

        foreach ($weathers as $weather) {
            $this->assertInstanceOf(Weather::class, $weather);
        }
    }
}
