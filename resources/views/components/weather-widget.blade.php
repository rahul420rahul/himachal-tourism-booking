<div class="weather-widget bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl p-6 text-white shadow-lg">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold">🌤️ Current Weather</h3>
        <div class="text-sm opacity-75">Bir Billing</div>
    </div>
    
    @if($weather)
        <div class="flex items-center mb-4">
            <img src="{{ app('App\Services\WeatherService')->getWeatherIcon($weather['icon']) }}" 
                 alt="{{ $weather['description'] }}" 
                 class="w-16 h-16 mr-4">
            <div>
                <div class="text-3xl font-bold">{{ $weather['temperature'] }}°C</div>
                <div class="text-sm opacity-90">{{ $weather['description'] }}</div>
                <div class="text-xs opacity-75">Feels like {{ $weather['feels_like'] }}°C</div>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4 text-sm">
            <div class="flex items-center">
                <span class="mr-2">💨</span>
                <span>Wind: {{ $weather['wind_speed'] }} m/s</span>
            </div>
            <div class="flex items-center">
                <span class="mr-2">💧</span>
                <span>Humidity: {{ $weather['humidity'] }}%</span>
            </div>
            <div class="flex items-center">
                <span class="mr-2">👁️</span>
                <span>Visibility: {{ $weather['visibility'] }}km</span>
            </div>
            <div class="flex items-center">
                <span class="mr-2">🎚️</span>
                <span>Pressure: {{ $weather['pressure'] }}mb</span>
            </div>
        </div>

        <!-- Paragliding Suitability -->
        <div class="bg-white/20 rounded-lg p-3">
            <div class="flex items-center justify-between">
                <span class="font-medium">Paragliding Conditions:</span>
                <span class="px-3 py-1 rounded-full text-xs font-semibold 
                    @switch($weather['suitable_for_paragliding'])
                        @case('excellent') bg-green-500 text-white @break
                        @case('good') bg-blue-500 text-white @break  
                        @case('fair') bg-yellow-500 text-black @break
                        @default bg-red-500 text-white @break
                    @endswitch">
                    @switch($weather['suitable_for_paragliding'])
                        @case('excellent') ✅ Excellent @break
                        @case('good') 😊 Good @break
                        @case('fair') ⚠️ Fair @break
                        @default ❌ Poor @break
                    @endswitch
                </span>
            </div>
            <div class="text-xs mt-1 opacity-80">
                @switch($weather['suitable_for_paragliding'])
                    @case('excellent') 
                        Perfect conditions for paragliding! Book now!
                        @break
                    @case('good') 
                        Good conditions for flying. Ideal for beginners.
                        @break
                    @case('fair') 
                        Fair conditions. Experienced pilots recommended.
                        @break
                    @default 
                        Not recommended for flying. Check forecast.
                        @break
                @endswitch
            </div>
        </div>

        <div class="text-xs opacity-75 mt-3 text-center">
            Last updated: {{ now()->format('h:i A') }}
        </div>
    @else
        <div class="text-center py-8">
            <div class="text-4xl mb-2">🌤️</div>
            <div class="text-lg">Weather data unavailable</div>
            <div class="text-sm opacity-75">Please check back later</div>
        </div>
    @endif
</div>

<!-- Weather Forecast (Optional) -->
@if(isset($forecast) && !empty($forecast))
<div class="mt-6">
    <h4 class="text-lg font-semibold mb-4 text-gray-800">📅 5-Day Forecast</h4>
    <div class="grid grid-cols-5 gap-2">
        @foreach($forecast as $day)
            <div class="bg-white rounded-lg p-3 shadow-sm text-center">
                <div class="text-xs font-medium text-gray-600 mb-1">
                    {{ $day['day_name'] }}
                </div>
                <img src="{{ app('App\Services\WeatherService')->getWeatherIcon($day['icon']) }}" 
                     alt="{{ $day['description'] }}" 
                     class="w-8 h-8 mx-auto mb-1">
                <div class="text-sm font-semibold text-gray-800">
                    {{ round($day['temp_max']) }}°
                </div>
                <div class="text-xs text-gray-500">
                    {{ round($day['temp_min']) }}°
                </div>
                <div class="text-xs mt-1">
                    @switch($day['suitable'])
                        @case('excellent') 
                            <span class="text-green-600">✅</span> 
                            @break
                        @case('good') 
                            <span class="text-blue-600">😊</span> 
                            @break
                        @case('fair') 
                            <span class="text-yellow-600">⚠️</span> 
                            @break
                        @default 
                            <span class="text-red-600">❌</span> 
                            @break
                    @endswitch
                </div>
            </div>
        @endforeach
    </div>
</div>
@endif
