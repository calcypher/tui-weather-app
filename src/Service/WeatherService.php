<?php
namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;

class WeatherService
{
    
    public function getCities()
    {
        $client = HttpClient::create();
        $response = $client->request('GET', 'https://sandbox.musement.com/api/v3/cities', [
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);
        
        $content = $response->getContent();
        // $content = '{"id":521583, "name":"symfony-docs", ...}'
        $content = $response->toArray();
        
        return $content;
    }
    
    public function getWeather($latitude, $longitude, $days)
    {
        $client = HttpClient::create();
        $response = $client->request('GET', 'https://api.weatherapi.com/v1/forecast.json?key=da9e96b00aa94fdfa48142125220601&q='.$latitude.','.$longitude.'&days='.$days);
        //echo 'https://api.weatherapi.com/v1/forecast.json?key=da9e96b00aa94fdfa48142125220601&q='.$latitude.','.$longitude.'&days='.$days;
        
        $statusCode = $response->getStatusCode();
        // $statusCode = 200
        $contentType = $response->getHeaders()['content-type'][0];
        // $contentType = 'application/json'
        $content = $response->getContent();
        // $content = '{"id":521583, "name":"symfony-docs", ...}'
        $content = $response->toArray();
        
        return $content;
    }
}

