<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation - {{ $booking->booking_number }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div class="min-h-screen py-8">
        <div class="max-w-2xl mx-auto px-4">
            <!-- Success Message -->
            <div class="bg-green-50 border border-green-200 rounded-lg p-6 mb-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-8 w-8 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-lg font-medium text-green-800">Booking Confirmed!</h3>
                        <p class="text-green-700">Your paragliding adventure is booked successfully.</p>
                    </div>
                </div>
            </div>

            <!-- Booking Details -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="px-6 py-4 bg-blue-600 text-white">
                    <h2 class="text-xl font-semibold">Booking Details</h2>
                    <p class="text-blue-100">Booking #{{ $booking->booking_number }}</p>
                </div>

                <div class="p-6 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Package</label>
                            <p class="text-lg font-semibold">{{ $booking->package->name }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Date</label>
                            <p class="text-lg">{{ date('d M Y', strtotime($booking->booking_date)) }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Participants</label>
                            <p class="text-lg">{{ $booking->participants }} {{ $booking->participants == 1 ? 'Person' : 'People' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Status</label>
                            <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full 
                                {{ $booking->status == 'confirmed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </div>
                    </div>

                    <div class="border-t pt-4">
                        <h3 class="font-semibold mb-2">Contact Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="text-gray-500">Name:</span> {{ $booking->guest_name }}
                            </div>
                            <div>
                                <span class="text-gray-500">Email:</span> {{ $booking->guest_email }}
                            </div>
                            <div>
                                <span class="text-gray-500">Phone:</span> {{ $booking->guest_phone }}
                            </div>
                        </div>
                    </div>

                    <div class="border-t pt-4">
                        <h3 class="font-semibold mb-2">Payment Information</h3>
                        <div class="bg-gray-50 rounded-lg p-4 space-y-2">
                            <div class="flex justify-between">
                                <span>Total Amount:</span>
                                <span class="font-medium">₹{{ number_format($booking->final_amount) }}</span>
                            </div>
                            <div class="flex justify-between text-green-600">
                                <span>Advance Paid:</span>
                                <span class="font-medium">₹{{ number_format($booking->advance_amount) }}</span>
                            </div>
                            <div class="flex justify-between text-orange-600">
                                <span>Balance (at venue):</span>
                                <span class="font-medium">₹{{ number_format($booking->pending_amount) }}</span>
                            </div>
                        </div>
                    </div>

                    @if($booking->special_requests)
                    <div class="border-t pt-4">
                        <h3 class="font-semibold mb-2">Special Requests</h3>
                        <p class="text-gray-700">{{ $booking->special_requests }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Important Notes -->
            <div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <h3 class="font-semibold text-yellow-800 mb-2">Important Information</h3>
                <ul class="text-sm text-yellow-700 space-y-1">
                    <li>• Please arrive 30 minutes before your scheduled time</li>
                    <li>• Carry a valid ID proof</li>
                    <li>• Weather conditions may affect flight schedules</li>
                    <li>• Balance payment to be made at the venue</li>
                </ul>
            </div>

            <!-- Contact Support -->
            <div class="mt-6 text-center">
                <p class="text-gray-600 mb-2">Need help? Contact us:</p>
                <a href="tel:+919736696260" class="text-blue-600 hover:underline font-medium">+91 97366 96260</a>
                <span class="mx-2">|</span>
                <a href="mailto:info@mybirbilling.com" class="text-blue-600 hover:underline font-medium">info@mybirbilling.com</a>
            </div>

            <div class="mt-6 text-center">
                <a href="/" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                    Back to Home
                </a>
            </div>
        </div>
    </div>
</body>
</html>
