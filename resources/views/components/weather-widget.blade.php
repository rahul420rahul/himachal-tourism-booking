<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Section - MyBirBilling</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        
        .weather-section {
            font-family: 'Inter', sans-serif;
            padding: 40px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .weather-header {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .weather-header h2 {
            font-size: 2.5rem;
            font-weight: 800;
            color: #2d3748;
            margin-bottom: 10px;
        }
        
        .weather-header p {
            font-size: 1.1rem;
            color: #718096;
            margin-bottom: 15px;
        }
        
        .location-badge {
            display: inline-flex;
            align-items: center;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 500;
        }
        
        .weather-controls {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 30px;
        }
        
        .weather-btn {
            background: #667eea;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }
        
        .weather-btn:hover {
            background: #5a67d8;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }
        
        .weather-btn.active {
            background: #764ba2;
        }
        
        .weather-main-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }
        
        .weather-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
        }
        
        .current-weather-main {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        
        .weather-info h3 {
            font-size: 1.8rem;
            color: #2d3748;
            margin-bottom: 5px;
        }
        
        .current-temperature {
            font-size: 3.5rem;
            font-weight: 800;
            color: #667eea;
            margin: 10px 0;
        }
        
        .current-condition {
            font-size: 1.2rem;
            color: #4a5568;
            margin-bottom: 8px;
        }
        
        .feels-like-temp {
            color: #718096;
            font-size: 0.95rem;
        }
        
        .weather-icon-large {
            font-size: 5rem;
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
        }
        
        .weather-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
        
        .stat-card {
            background: #f8fafc;
            padding: 20px;
            border-radius: 15px;
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
        }
        
        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }
        
        .stat-icon {
            font-size: 2rem;
            margin-bottom: 8px;
        }
        
        .stat-label {
            color: #718096;
            font-size: 0.85rem;
            margin-bottom: 5px;
            font-weight: 500;
        }
        
        .stat-value {
            font-size: 1.4rem;
            font-weight: 700;
            color: #2d3748;
        }
        
        .flight-status h4 {
            font-size: 1.4rem;
            color: #2d3748;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .status-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            margin-bottom: 12px;
            background: #f8fafc;
            border-radius: 12px;
            border-left: 4px solid transparent;
            transition: all 0.2s ease;
        }
        
        .status-item:hover {
            transform: translateX(5px);
        }
        
        .status-item.excellent { border-left-color: #48bb78; background: #f0fff4; }
        .status-item.good { border-left-color: #4299e1; background: #f0f9ff; }
        .status-item.fair { border-left-color: #ed8936; background: #fffaf0; }
        .status-item.poor { border-left-color: #f56565; background: #fffafa; }
        
        .status-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
            color: #2d3748;
        }
        
        .status-badge {
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .badge-excellent { background: #c6f6d5; color: #22543d; }
        .badge-good { background: #bee3f8; color: #2a4365; }
        .badge-fair { background: #fbd38d; color: #7b341e; }
        .badge-poor { background: #fed7d7; color: #742a2a; }
        
        .overall-flight-status {
            text-align: center;
            padding: 20px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 15px;
            color: white;
            margin-top: 20px;
        }
        
        .overall-badge {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 8px;
        }
        
        .flight-advice {
            opacity: 0.9;
            line-height: 1.4;
            font-size: 0.9rem;
        }
        
        .forecast-section {
            margin-top: 20px;
        }
        
        .forecast-section h4 {
            font-size: 1.8rem;
            color: #2d3748;
            margin-bottom: 25px;
            text-align: center;
        }
        
        .forecast-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 20px;
        }
        
        .forecast-item {
            background: white;
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
        }
        
        .forecast-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }
        
        .forecast-day {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 10px;
            font-size: 0.9rem;
        }
        
        .forecast-icon {
            font-size: 2.2rem;
            margin: 8px 0;
        }
        
        .forecast-temp {
            font-size: 1.2rem;
            font-weight: 700;
            color: #667eea;
            margin-bottom: 5px;
        }
        
        .forecast-condition {
            font-size: 0.8rem;
            color: #718096;
            margin-bottom: 8px;
        }
        
        .forecast-wind {
            font-size: 0.75rem;
            color: #a0aec0;
        }
        
        .hourly-section {
            margin-top: 20px;
        }
        
        .hourly-grid {
            display: flex;
            gap: 15px;
            overflow-x: auto;
            padding: 10px 0;
        }
        
        .hourly-item {
            background: white;
            border-radius: 12px;
            padding: 15px;
            text-align: center;
            min-width: 90px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
            flex-shrink: 0;
        }
        
        .hourly-time {
            font-size: 0.8rem;
            color: #718096;
            margin-bottom: 6px;
            font-weight: 500;
        }
        
        .hourly-icon {
            font-size: 1.6rem;
            margin: 4px 0;
        }
        
        .hourly-temp {
            font-weight: 600;
            color: #2d3748;
            font-size: 0.9rem;
        }
        
        /* Responsive */
        @media (max-width: 1024px) {
            .weather-main-grid {
                grid-template-columns: 1fr;
            }
            
            .forecast-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        
        @media (max-width: 768px) {
            .weather-section {
                padding: 30px 15px;
            }
            
            .weather-header h2 {
                font-size: 2rem;
            }
            
            .current-weather-main {
                flex-direction: column;
                text-align: center;
            }
            
            .current-temperature {
                font-size: 2.8rem;
            }
            
            .forecast-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .weather-stats {
                grid-template-columns: 1fr;
            }
            
            .weather-controls {
                flex-wrap: wrap;
                gap: 10px;
            }
            
            .weather-btn {
                padding: 10px 18px;
                font-size: 0.9rem;
            }
        }
        
        @media (max-width: 480px) {
            .weather-card {
                padding: 20px;
            }
            
            .forecast-grid {
                grid-template-columns: 1fr;
            }
            
            .weather-main-grid {
                gap: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Weather Section - Can be easily included in any page -->
    <section class="weather-section">
        <!-- Header -->
        <div class="weather-header">
            <h2>Weather Information</h2>
            <p>Real-time weather data for paragliding conditions</p>
            <div class="location-badge">
                📍 Billing, Himachal Pradesh
            </div>
        </div>
        
        <!-- Controls -->
        <div class="weather-controls">
            <button class="weather-btn active" onclick="showWeatherSection('current')">Current Weather</button>
            <button class="weather-btn" onclick="showWeatherSection('forecast')">5-Day Forecast</button>
            <button class="weather-btn" onclick="showWeatherSection('hourly')">Hourly</button>
        </div>
        
        <!-- Current Weather Section -->
        <div id="currentWeatherSection">
            <div class="weather-main-grid">
                <!-- Current Weather Card -->
                <div class="weather-card">
                    <div class="current-weather-main">
                        <div class="weather-info">
                            <h3 id="currentLocation">Billing, HP</h3>
                            <div class="current-temperature" id="currentTemp">24°C</div>
                            <div class="current-condition" id="currentCondition">Partly Cloudy</div>
                            <div class="feels-like-temp" id="feelsLike">Feels like 26°C</div>
                        </div>
                        <div class="weather-icon-large" id="currentIcon">⛅</div>
                    </div>
                    
                    <div class="weather-stats">
                        <div class="stat-card">
                            <div class="stat-icon">💧</div>
                            <div class="stat-label">Humidity</div>
                            <div class="stat-value" id="humidity">68%</div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-icon">💨</div>
                            <div class="stat-label">Wind Speed</div>
                            <div class="stat-value" id="windSpeed">6 m/s</div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-icon">👁️</div>
                            <div class="stat-label">Visibility</div>
                            <div class="stat-value" id="visibility">15 km</div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-icon">⏲️</div>
                            <div class="stat-label">Pressure</div>
                            <div class="stat-value" id="pressure">1013 hPa</div>
                        </div>
                    </div>
                </div>
                
                <!-- Flight Status Card -->
                <div class="weather-card flight-status">
                    <h4>🪂 Flight Conditions</h4>
                    
                    <div class="status-item good">
                        <div class="status-label">
                            <span>💨</span>
                            <span>Wind</span>
                        </div>
                        <div class="status-badge badge-good" id="windStatus">Good</div>
                    </div>
                    
                    <div class="status-item excellent">
                        <div class="status-label">
                            <span>👁️</span>
                            <span>Visibility</span>
                        </div>
                        <div class="status-badge badge-excellent">Excellent</div>
                    </div>
                    
                    <div class="status-item good">
                        <div class="status-label">
                            <span>☁️</span>
                            <span>Weather</span>
                        </div>
                        <div class="status-badge badge-good" id="weatherStatus">Good</div>
                    </div>
                    
                    <div class="overall-flight-status">
                        <div class="overall-badge" id="overallStatus">Good Flying Conditions</div>
                        <div class="flight-advice" id="flightAdvice">
                            Conditions are suitable for paragliding with normal precautions.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- 5-Day Forecast Section -->
        <div id="forecastWeatherSection" style="display: none;">
            <div class="weather-card forecast-section">
                <h4>📅 5-Day Forecast</h4>
                <div class="forecast-grid" id="forecastGrid">
                    <!-- Forecast items will be populated by JavaScript -->
                </div>
            </div>
        </div>
        
        <!-- Hourly Forecast Section -->
        <div id="hourlyWeatherSection" style="display: none;">
            <div class="weather-card hourly-section">
                <h4>⏰ Next 24 Hours</h4>
                <div class="hourly-grid" id="hourlyGrid">
                    <!-- Hourly items will be populated by JavaScript -->
                </div>
            </div>
        </div>
    </section>
    
    <script>
        // Weather data
        const weatherData = {
            current: {
                temperature: 24,
                feels_like: 26,
                condition: 'Partly Cloudy',
                icon: '⛅',
                wind_speed: 6,
                wind_direction: 'NW',
                humidity: 68,
                visibility: 15,
                pressure: 1013
            },
            forecast: [
                { day: 'Today', temp: 24, condition: 'Partly Cloudy', icon: '⛅', wind: 6 },
                { day: 'Tomorrow', temp: 26, condition: 'Sunny', icon: '☀️', wind: 4 },
                { day: 'Wednesday', temp: 22, condition: 'Light Rain', icon: '🌦️', wind: 12 },
                { day: 'Thursday', temp: 25, condition: 'Clear Sky', icon: '☀️', wind: 3 },
                { day: 'Friday', temp: 27, condition: 'Sunny', icon: '☀️', wind: 7 }
            ],
            hourly: [
                { time: 'Now', temp: 24, icon: '⛅' },
                { time: '2 PM', temp: 26, icon: '☀️' },
                { time: '4 PM', temp: 27, icon: '☀️' },
                { time: '6 PM', temp: 25, icon: '⛅' },
                { time: '8 PM', temp: 22, icon: '🌙' },
                { time: '10 PM', temp: 20, icon: '🌙' },
                { time: '12 AM', temp: 18, icon: '🌙' },
                { time: '2 AM', temp: 17, icon: '🌙' }
            ]
        };
        
        // Show/hide weather sections
        function showWeatherSection(section) {
            // Hide all sections
            document.getElementById('currentWeatherSection').style.display = 'none';
            document.getElementById('forecastWeatherSection').style.display = 'none';
            document.getElementById('hourlyWeatherSection').style.display = 'none';
            
            // Remove active class from all buttons
            document.querySelectorAll('.weather-btn').forEach(btn => btn.classList.remove('active'));
            
            // Show selected section and add active class to clicked button
            const clickedBtn = event.target;
            clickedBtn.classList.add('active');
            
            if (section === 'current') {
                document.getElementById('currentWeatherSection').style.display = 'block';
            } else if (section === 'forecast') {
                document.getElementById('forecastWeatherSection').style.display = 'block';
                generateForecast();
            } else if (section === 'hourly') {
                document.getElementById('hourlyWeatherSection').style.display = 'block';
                generateHourly();
            }
        }
        
        // Update current weather display
        function updateCurrentWeather() {
            document.getElementById('currentTemp').textContent = weatherData.current.temperature + '°C';
            document.getElementById('currentCondition').textContent = weatherData.current.condition;
            document.getElementById('feelsLike').textContent = `Feels like ${weatherData.current.feels_like}°C`;
            document.getElementById('currentIcon').textContent = weatherData.current.icon;
            document.getElementById('humidity').textContent = weatherData.current.humidity + '%';
            document.getElementById('windSpeed').textContent = weatherData.current.wind_speed + ' m/s';
            document.getElementById('visibility').textContent = weatherData.current.visibility + ' km';
            document.getElementById('pressure').textContent = weatherData.current.pressure + ' hPa';
        }
        
        // Get flight status based on conditions
        function getFlightStatus() {
            const wind = weatherData.current.wind_speed;
            const condition = weatherData.current.condition.toLowerCase();
            
            let windStatus = 'good';
            if (wind <= 3) windStatus = 'excellent';
            else if (wind <= 7) windStatus = 'good';
            else if (wind <= 12) windStatus = 'fair';
            else windStatus = 'poor';
            
            let weatherStatus = 'good';
            if (condition.includes('sunny') || condition.includes('clear')) weatherStatus = 'excellent';
            else if (condition.includes('rain') || condition.includes('storm')) weatherStatus = 'poor';
            else if (condition.includes('cloudy')) weatherStatus = 'good';
            
            return { windStatus, weatherStatus };
        }
        
        // Update flight status
        function updateFlightStatus() {
            const status = getFlightStatus();
            
            // Update wind status
            const windStatusEl = document.getElementById('windStatus');
            windStatusEl.textContent = status.windStatus.charAt(0).toUpperCase() + status.windStatus.slice(1);
            windStatusEl.className = `status-badge badge-${status.windStatus}`;
            
            // Update weather status
            const weatherStatusEl = document.getElementById('weatherStatus');
            weatherStatusEl.textContent = status.weatherStatus.charAt(0).toUpperCase() + status.weatherStatus.slice(1);
            weatherStatusEl.className = `status-badge badge-${status.weatherStatus}`;
            
            // Overall status
            let overall = 'good';
            if (status.windStatus === 'excellent' && status.weatherStatus === 'excellent') overall = 'excellent';
            else if (status.windStatus === 'poor' || status.weatherStatus === 'poor') overall = 'poor';
            else if (status.windStatus === 'fair' || status.weatherStatus === 'fair') overall = 'fair';
            
            const overallEl = document.getElementById('overallStatus');
            const adviceEl = document.getElementById('flightAdvice');
            
            switch (overall) {
                case 'excellent':
                    overallEl.textContent = 'Excellent Flying Conditions';
                    adviceEl.textContent = 'Perfect conditions for paragliding! Enjoy your flight.';
                    break;
                case 'good':
                    overallEl.textContent = 'Good Flying Conditions';
                    adviceEl.textContent = 'Conditions are suitable for paragliding with normal precautions.';
                    break;
                case 'fair':
                    overallEl.textContent = 'Fair Flying Conditions';
                    adviceEl.textContent = 'Suitable for experienced pilots. Monitor conditions closely.';
                    break;
                case 'poor':
                    overallEl.textContent = 'Poor Flying Conditions';
                    adviceEl.textContent = 'Not recommended for flying. Wait for better conditions.';
                    break;
            }
        }
        
        // Generate forecast
        function generateForecast() {
            const grid = document.getElementById('forecastGrid');
            grid.innerHTML = '';
            
            weatherData.forecast.forEach((day, index) => {
                const item = document.createElement('div');
                item.className = 'forecast-item';
                item.innerHTML = `
                    <div class="forecast-day">${day.day}</div>
                    <div class="forecast-icon">${day.icon}</div>
                    <div class="forecast-temp">${day.temp}°C</div>
                    <div class="forecast-condition">${day.condition}</div>
                    <div class="forecast-wind">Wind: ${day.wind} m/s</div>
                `;
                grid.appendChild(item);
            });
        }
        
        // Generate hourly forecast
        function generateHourly() {
            const grid = document.getElementById('hourlyGrid');
            grid.innerHTML = '';
            
            weatherData.hourly.forEach((hour, index) => {
                const item = document.createElement('div');
                item.className = 'hourly-item';
                item.innerHTML = `
                    <div class="hourly-time">${hour.time}</div>
                    <div class="hourly-icon">${hour.icon}</div>
                    <div class="hourly-temp">${hour.temp}°C</div>
                `;
                grid.appendChild(item);
            });
        }
        
        // Simulate real-time updates
        function simulateUpdates() {
            // Small random changes to weather data
            weatherData.current.temperature += (Math.random() - 0.5) * 2;
            weatherData.current.wind_speed += (Math.random() - 0.5) * 1;
            weatherData.current.humidity += Math.floor((Math.random() - 0.5) * 4);
            
            // Keep values in realistic ranges
            weatherData.current.temperature = Math.max(15, Math.min(35, Math.round(weatherData.current.temperature)));
            weatherData.current.wind_speed = Math.max(0, Math.min(20, Math.round(weatherData.current.wind_speed * 10) / 10));
            weatherData.current.humidity = Math.max(30, Math.min(90, weatherData.current.humidity));
            
            updateCurrentWeather();
            updateFlightStatus();
        }
        
        // Initialize weather section
        function initWeatherSection() {
            updateCurrentWeather();
            updateFlightStatus();
            
            // Update every 30 seconds for demo
            setInterval(simulateUpdates, 30000);
        }
        
        // Auto-start when page loads
        document.addEventListener('DOMContentLoaded', initWeatherSection);
    </script>
</body>
</html>