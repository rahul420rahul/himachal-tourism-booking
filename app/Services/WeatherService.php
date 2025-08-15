<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class WeatherService
{
    private $apiKey;
    private $baseUrl = 'https://api.openweathermap.org/data/2.5';

    public function __construct()
    {
        $this->apiKey = config('services.openweather.api_key');
    }

    public function getCurrentWeather($lat = 32.0504, $lon = 76.7255) // Bir Billing coordinates
    {
        $cacheKey = "weather_current_{$lat}_{$lon}";
        
        return Cache::remember($cacheKey, 600, function() use ($lat, $lon) {
            try {
                $response = Http::get("{$this->baseUrl}/weather", [
                    'lat' => $lat,
                    'lon' => $lon,
                    'appid' => $this->apiKey,
                    'units' => 'metric'
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    return [
                        'temperature' => round($data['main']['temp']),
                        'description' => ucfirst($data['weather'][0]['description']),
                        'icon' => $data['weather'][0]['icon'],
                        'wind_speed' => $data['wind']['speed'] ?? 0,
                        'humidity' => $data['main']['humidity'],
                        'pressure' => $data['main']['pressure'],
                        'visibility' => isset($data['visibility']) ? $data['visibility'] / 1000 : 'N/A',
                        'feels_like' => round($data['main']['feels_like']),
                        'suitable_for_paragliding' => $this->isGoodForParagliding($data)
                    ];
                }
            } catch (\Exception $e) {
                \Log::error('Weather API Error: ' . $e->getMessage());
            }

            return $this->getDefaultWeather();
        });
    }

    public function getForecast($lat = 32.0504, $lon = 76.7255, $days = 5)
    {
        $cacheKey = "weather_forecast_{$lat}_{$lon}_{$days}";
        
        return Cache::remember($cacheKey, 3600, function() use ($lat, $lon, $days) {
            try {
                $response = Http::get("{$this->baseUrl}/forecast", [
                    'lat' => $lat,
                    'lon' => $lon,
                    'appid' => $this->apiKey,
                    'units' => 'metric',
                    'cnt' => $days * 8 // 8 forecasts per day (3-hour intervals)
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    $forecast = [];

                    foreach ($data['list'] as $item) {
                        $date = date('Y-m-d', $item['dt']);
                        
                        if (!isset($forecast[$date])) {
                            $forecast[$date] = [
                                'date' => $date,
                                'day_name' => date('D', $item['dt']),
                                'temp_max' => $item['main']['temp_max'],
                                'temp_min' => $item['main']['temp_min'],
                                'description' => ucfirst($item['weather'][0]['description']),
                                'icon' => $item['weather'][0]['icon'],
                                'wind_speed' => $item['wind']['speed'] ?? 0,
                                'suitable' => $this->isGoodForParagliding($item)
                            ];
                        } else {
                            // Update max/min temps
                            $forecast[$date]['temp_max'] = max($forecast[$date]['temp_max'], $item['main']['temp_max']);
                            $forecast[$date]['temp_min'] = min($forecast[$date]['temp_min'], $item['main']['temp_min']);
                        }
                    }

                    return array_values($forecast);
                }
            } catch (\Exception $e) {
                \Log::error('Weather Forecast Error: ' . $e->getMessage());
            }

            return [];
        });
    }

    private function isGoodForParagliding($weatherData)
    {
        $windSpeed = $weatherData['wind']['speed'] ?? 0;
        $weatherId = $weatherData['weather'][0]['id'] ?? 800;
        
        // Good conditions: Wind speed 3-7 m/s, clear/partly cloudy weather
        $goodWind = $windSpeed >= 3 && $windSpeed <= 7;
        $goodWeather = in_array($weatherId, [800, 801, 802]); // Clear, few clouds, scattered clouds
        
        if ($goodWind && $goodWeather) {
            return 'excellent';
        } elseif ($windSpeed <= 10 && $weatherId < 700) {
            return 'good';
        } elseif ($windSpeed <= 15 && $weatherId < 600) {
            return 'fair';
        } else {
            return 'poor';
        }
    }

    private function getDefaultWeather()
    {
        return [
            'temperature' => 22,
            'description' => 'Pleasant weather',
            'icon' => '01d',
            'wind_speed' => 5,
            'humidity' => 65,
            'pressure' => 1013,
            'visibility' => 10,
            'feels_like' => 23,
            'suitable_for_paragliding' => 'good'
        ];
    }

    public function getWeatherIcon($iconCode)
    {
        return "https://openweathermap.org/img/wn/{$iconCode}@2x.png";
    }
}
