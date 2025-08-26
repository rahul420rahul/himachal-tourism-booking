@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-xl p-8">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Flight Log</h1>
            
            <form action="{{ route('dashboard.flight-logs.update', $flightLog) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Flight Date -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Flight Date *</label>
                        <input type="date" name="date" required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                               value="{{ old('date', $flightLog->date->format('Y-m-d')) }}">
                    </div>
                    
                    <!-- Site Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Site Name *</label>
                        <input type="text" name="site_name" required placeholder="e.g., Bir Billing, Kamshet"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                               value="{{ old('site_name', $flightLog->site_name) }}">
                    </div>
                    
                    <!-- Launch Time -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Launch Time *</label>
                        <input type="time" name="launch_time" required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                               value="{{ old('launch_time', $flightLog->launch_time->format('H:i')) }}">
                    </div>
                    
                    <!-- Landing Time -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Landing Time *</label>
                        <input type="time" name="landing_time" required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                               value="{{ old('landing_time', $flightLog->landing_time->format('H:i')) }}">
                    </div>
                    
                    <!-- Max Altitude -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Max Altitude (meters)</label>
                        <input type="number" name="max_altitude" placeholder="e.g., 2500"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                               value="{{ old('max_altitude', $flightLog->max_altitude) }}">
                    </div>
                    
                    <!-- Distance -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Distance (km)</label>
                        <input type="number" step="0.1" name="distance" placeholder="e.g., 15.5"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                               value="{{ old('distance', $flightLog->distance) }}">
                    </div>
                    
                    <!-- Glider Model -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Glider Model</label>
                        <input type="text" name="glider_model" placeholder="e.g., Advance Alpha 6"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                               value="{{ old('glider_model', $flightLog->glider_model) }}">
                    </div>
                    
                    <!-- Wind Speed -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Wind Speed</label>
                        <input type="text" name="wind_speed" placeholder="e.g., 15 km/h"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                               value="{{ old('wind_speed', $flightLog->wind_speed) }}">
                    </div>
                    
                    <!-- Wind Direction -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Wind Direction</label>
                        <select name="wind_direction" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="">Select Direction</option>
                            <option value="N" {{ $flightLog->wind_direction == 'N' ? 'selected' : '' }}>North (N)</option>
                            <option value="NE" {{ $flightLog->wind_direction == 'NE' ? 'selected' : '' }}>North-East (NE)</option>
                            <option value="E" {{ $flightLog->wind_direction == 'E' ? 'selected' : '' }}>East (E)</option>
                            <option value="SE" {{ $flightLog->wind_direction == 'SE' ? 'selected' : '' }}>South-East (SE)</option>
                            <option value="S" {{ $flightLog->wind_direction == 'S' ? 'selected' : '' }}>South (S)</option>
                            <option value="SW" {{ $flightLog->wind_direction == 'SW' ? 'selected' : '' }}>South-West (SW)</option>
                            <option value="W" {{ $flightLog->wind_direction == 'W' ? 'selected' : '' }}>West (W)</option>
                            <option value="NW" {{ $flightLog->wind_direction == 'NW' ? 'selected' : '' }}>North-West (NW)</option>
                        </select>
                    </div>
                    
                    <!-- Weather Conditions -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Weather Conditions</label>
                        <textarea name="weather_conditions" rows="2" placeholder="Describe weather conditions..."
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('weather_conditions', $flightLog->weather_conditions) }}</textarea>
                    </div>
                    
                    <!-- Flight Notes -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Flight Notes</label>
                        <textarea name="notes" rows="3" placeholder="Any special notes about this flight..."
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('notes', $flightLog->notes) }}</textarea>
                    </div>
                </div>
                
                <!-- Submit Buttons -->
                <div class="mt-8 flex justify-end space-x-4">
                    <a href="{{ route('dashboard.flight-logs') }}" 
                       class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        Update Flight Log
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
