<?php

namespace App\Http\Controllers;

use App\Services\WeatherService;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    private $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function getCurrentWeather($city = 'Billing')
    {
        try {
            $weather = $this->weatherService->getCurrentWeather($city);
            return response()->json($weather);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Weather data not available'], 500);
        }
    }
}
