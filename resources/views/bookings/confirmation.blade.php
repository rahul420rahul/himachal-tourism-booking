@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-500 via-purple-600 to-green-400 py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-xl overflow-hidden">
            <!-- Success Header -->
            <div class="bg-gradient-to-r from-green-500 to-blue-600 text-white text-center py-8">
                <div class="text-6xl mb-4">🎉</div>
                <h1 class="text-3xl font-bold mb-2">Booking Confirmed!</h1>
                <p class="text-lg opacity-90">Thank you for choosing Bir Billing Adventures</p>
            </div>

            <!-- Content -->
            <div class="p-8">
                <p class="text-lg mb-6">
                    Hello <span class="font-semibold text-blue-600">{{ $booking->name }}</span>! 👋<br>
                    Your booking has been <span class="font-semibold text-green-600">successfully confirmed</span>. Get ready for an amazing adventure!
                </p>

                <!-- Booking Details -->
                <div class="bg-gray-50 rounded-lg p-6 mb-8">
                    <h2 class="text-xl font-semibold mb-4 flex items-center">
                        📋 Booking Details
                    </h2>

                    <div class="space-y-3">
                        <div class="flex justify-between items-center py-2 border-b border-gray-200">
                            <span class="font-medium">Booking Number:</span>
                            <span class="font-mono bg-blue-100 text-blue-800 px-3 py-1 rounded">{{ $booking->booking_number }}</span>
                        </div>

                        <div class="flex justify-between items-center py-2 border-b border-gray-200">
                            <span class="font-medium">Package:</span>
                            <span class="text-right">{{ $booking->package->name }}</span>
                        </div>

                        <div class="flex justify-between items-center py-2 border-b border-gray-200">
                            <span class="font-medium">Date:</span>
                            <span>{{ \Carbon\Carbon::parse($booking->travel_date)->format('d M Y') }}</span>
                        </div>

                        @if($booking->time_slot)
                        <div class="flex justify-between items-center py-2 border-b border-gray-200">
                            <span class="font-medium">Time Slot:</span>
                            <span>{{ $booking->time_slot }}</span>
                        </div>
                        @endif

                        <div class="flex justify-between items-center py-2 border-b border-gray-200">
                            <span class="font-medium">Participants:</span>
                            <span>{{ $booking->adults + $booking->children }} person(s)</span>
                        </div>

                        <div class="flex justify-between items-center py-2 border-b border-gray-200">
                            <span class="font-medium">Total Amount:</span>
                            <span class="text-xl font-bold text-green-600">₹{{ number_format($booking->total_amount, 2) }}</span>
                        </div>

                        <div class="flex justify-between items-center py-2">
                            <span class="font-medium">Payment Status:</span>
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">
                                {{ strtoupper($booking->payment_status) }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Weather Update Section -->
                @if(isset($weather) && is_array($weather))
                <div class="bg-blue-50 rounded-lg p-6 mb-8">
                    <h3 class="text-lg font-semibold text-blue-800 mb-3 flex items-center">
                        🌤️ Weather Update for Your Adventure
                    </h3>
                    <div class="text-blue-700">
                        <p><strong>Temperature:</strong> {{ $weather['temperature'] ?? 'N/A' }}°C - {{ $weather['description'] ?? 'Pleasant weather expected' }}</p>
                        <p><strong>Wind Speed:</strong> {{ $weather['wind_speed'] ?? 'Moderate' }} m/s | <strong>Humidity:</strong> {{ $weather['humidity'] ?? 'Normal' }}%</p>
                        <div class="mt-2 p-3 bg-blue-100 rounded text-sm">
                            <strong>Weather Conditions:</strong> {{ $weather['suitable'] ?? 'Good' }} for paragliding! 
                            @if(isset($weather['advice']))
                                {{ $weather['advice'] }}
                            @else
                                ✅ Excellent climate! 🪂 Great flyability! ⚠️ Fair (Expect crowds!)
                            @endif
                        </div>
                    </div>
                </div>
                @endif

                <!-- What's Next Section -->
                <div class="bg-yellow-50 rounded-lg p-6 mb-8">
                    <h3 class="text-lg font-semibold text-yellow-800 mb-3">📋 What's Next?</h3>
                    <ul class="text-yellow-700 space-y-2">
                        <li class="flex items-start">
                            <span class="text-yellow-600 mr-2">✓</span>
                            Save this confirmation for your records
                        </li>
                        <li class="flex items-start">
                            <span class="text-yellow-600 mr-2">✓</span>
                            Our team will contact you 24-48 hours before your adventure
                        </li>
                        <li class="flex items-start">
                            <span class="text-yellow-600 mr-2">✓</span>
                            Bring valid ID and comfortable clothing
                        </li>
                        <li class="flex items-start">
                            <span class="text-yellow-600 mr-2">✓</span>
                            Arrive at the designated meeting point on time
                        </li>
                    </ul>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('bookings.index') }}" 
                       class="flex-1 bg-blue-600 text-white text-center py-3 px-6 rounded-lg font-semibold hover:bg-blue-700 transition duration-200">
                        View My Bookings
                    </a>
                    <a href="{{ route('packages.index') }}" 
                       class="flex-1 bg-gray-600 text-white text-center py-3 px-6 rounded-lg font-semibold hover:bg-gray-700 transition duration-200">
                        Book Another Package
                    </a>
                </div>

                <!-- Contact Info -->
                <div class="text-center mt-8 pt-8 border-t border-gray-200">
                    <p class="text-gray-600 mb-2">Have questions? We're here to help!</p>
                    <div class="flex justify-center space-x-6 text-sm text-gray-500">
                        <span>📞 +91 98765 43210</span>
                        <span>📧 info@mybirbilling.com</span>
                        <span>📍 Billing, Himachal Pradesh</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
