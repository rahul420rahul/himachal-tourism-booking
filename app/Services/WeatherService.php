<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class WeatherService
{
    private $apiKey;
    private $baseUrl = 'https://api.openweathermap.org/data/2.5/weather';

    public function __construct()
    {
        $this->apiKey = config('services.weather.api_key', env('WEATHER_API_KEY'));
    }

    public function getCurrentWeather($city = 'Billing')
    {
        if (!$this->apiKey || $this->apiKey === 'your_openweather_api_key') {
            return $this->getMockWeatherData($city);
        }

        $cacheKey = 'weather_' . strtolower($city);
        
        return Cache::remember($cacheKey, 1800, function () use ($city) {
            try {
                $response = Http::get($this->baseUrl, [
                    'q' => $city . ',IN',
                    'appid' => $this->apiKey,
                    'units' => 'metric'
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    return [
                        'city' => $data['name'],
                        'temperature' => $data['main']['temp'],
                        'description' => $data['weather'][0]['description'],
                        'humidity' => $data['main']['humidity'],
                        'wind_speed' => $data['wind']['speed'],
                        'icon' => $data['weather'][0]['icon']
                    ];
                }
                
                return $this->getMockWeatherData($city);
            } catch (\Exception $e) {
                return $this->getMockWeatherData($city);
            }
        });
    }

    private function getMockWeatherData($city)
    {
        return [
            'city' => $city,
            'temperature' => rand(15, 25),
            'description' => 'partly cloudy',
            'humidity' => rand(60, 80),
            'wind_speed' => rand(5, 15),
            'icon' => '02d'
        ];
    }
}
