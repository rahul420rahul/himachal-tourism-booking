@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Success Alert if coming from payment -->
        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        <!-- Booking Header Card -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-blue-600 to-green-600 text-white p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-3xl font-bold mb-2">Booking Confirmed!</h1>
                        <p class="text-blue-100">Booking ID: <span class="font-mono font-bold">{{ $booking->booking_number }}</span></p>
                        <p class="text-sm mt-1">Booked on: {{ $booking->created_at->format('d M Y, h:i A') }}</p>
                    </div>
                    <div class="text-right">
                        @if($booking->payment_status == 'paid')
                            <span class="inline-block px-4 py-2 bg-green-500 text-white rounded-full text-sm font-semibold">
                                ✓ Fully Paid
                            </span>
                        @elseif($booking->payment_status == 'partial' || $booking->payment_status == 'processing')
                            <span class="inline-block px-4 py-2 bg-yellow-500 text-white rounded-full text-sm font-semibold">
                                ⏳ Advance Paid
                            </span>
                        @else
                            <span class="inline-block px-4 py-2 bg-red-500 text-white rounded-full text-sm font-semibold">
                                ⚠ Payment Pending
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Package & Guest Details -->
            <div class="p-6">
                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <!-- Package Information -->
                    <div class="border-r pr-6">
                        <h3 class="text-lg font-semibold mb-3 text-gray-800">Package Details</h3>
                        <div class="space-y-2">
                            <p class="flex justify-between">
                                <span class="text-gray-600">Package:</span>
                                <span class="font-semibold">{{ $booking->package->name ?? 'N/A' }}</span>
                            </p>
                            <p class="flex justify-between">
                                <span class="text-gray-600">Date:</span>
                                <span class="font-semibold">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</span>
                            </p>
                            <p class="flex justify-between">
                                <span class="text-gray-600">Time Slot:</span>
                                <span class="font-semibold">{{ $booking->time_slot }}</span>
                            </p>
                            <p class="flex justify-between">
                                <span class="text-gray-600">Participants:</span>
                                <span class="font-semibold">{{ $booking->participants }} Person(s)</span>
                            </p>
                            <p class="flex justify-between">
                                <span class="text-gray-600">Location:</span>
                                <span class="font-semibold">Bir Billing, HP</span>
                            </p>
                        </div>
                    </div>

                    <!-- Guest Information -->
                    <div class="pl-6">
                        <h3 class="text-lg font-semibold mb-3 text-gray-800">Guest Information</h3>
                        <div class="space-y-2">
                            <p class="flex justify-between">
                                <span class="text-gray-600">Name:</span>
                                <span class="font-semibold">{{ $booking->guest_name ?: ($booking->user->name ?? 'Guest') }}</span>
                            </p>
                            <p class="flex justify-between">
                                <span class="text-gray-600">Email:</span>
                                <span class="font-semibold">{{ $booking->guest_email ?: ($booking->user->email ?? 'N/A') }}</span>
                            </p>
                            <p class="flex justify-between">
                                <span class="text-gray-600">Phone:</span>
                                <span class="font-semibold">{{ $booking->guest_phone ?: 'N/A' }}</span>
                            </p>
                            @if($booking->special_requests)
                            <div>
                                <span class="text-gray-600">Special Requests:</span>
                                <p class="font-semibold mt-1">{{ $booking->special_requests }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Payment Summary -->
                <div class="border-t pt-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-800">Payment Summary</h3>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="space-y-2">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Package Price:</span>
                                <span class="font-semibold">₹{{ number_format($booking->package_price ?: $booking->package->price ?? 0, 2) }} × {{ $booking->participants }}</span>
                            </div>
                            <div class="flex justify-between items-center text-lg">
                                <span class="text-gray-700 font-medium">Total Amount:</span>
                                <span class="font-bold">₹{{ number_format($booking->final_amount, 2) }}</span>
                            </div>
                            
                            <div class="border-t pt-2 mt-2">
                                @php
                                    $advanceAmount = $booking->advance_amount > 0 ? $booking->advance_amount : ($booking->final_amount * 0.2);
                                    $pendingAmount = $booking->pending_amount > 0 ? $booking->pending_amount : ($booking->final_amount - $advanceAmount);
                                @endphp
                                
                                <div class="flex justify-between items-center text-green-600">
                                    <span class="font-medium">Advance Paid:</span>
                                    <span class="font-bold text-lg">₹{{ number_format($advanceAmount, 2) }}</span>
                                </div>
                                
                                @if($pendingAmount > 0)
                                <div class="flex justify-between items-center text-orange-600 mt-2">
                                    <span class="font-medium">Balance Due (Pay at Venue):</span>
                                    <span class="font-bold text-lg">₹{{ number_format($pendingAmount, 2) }}</span>
                                </div>
                                @endif
                            </div>

                            @if($booking->razorpay_payment_id)
                            <div class="border-t pt-2 mt-2">
                                <p class="text-sm text-gray-500">
                                    Payment ID: {{ $booking->razorpay_payment_id }}
                                </p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Important Information -->
                <div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <h4 class="font-semibold text-yellow-800 mb-2">Important Information</h4>
                    <ul class="text-sm text-gray-700 space-y-1">
                        <li>• Please arrive 30 minutes before your scheduled time</li>
                        <li>• Carry a valid ID proof</li>
                        <li>• Wear comfortable clothes and shoes</li>
                        @if($pendingAmount > 0)
                        <li class="font-semibold text-orange-700">• Balance amount of ₹{{ number_format($pendingAmount, 2) }} to be paid at venue</li>
                        @endif
                        <li>• Activity is subject to weather conditions</li>
                    </ul>
                </div>

                <!-- Action Buttons -->
                <div class="mt-6 flex gap-4">
                    <a href="{{ route('dashboard') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                        Go to Dashboard
                    </a>
                    <button onclick="window.print()" class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700">
                        Print Booking
                    </button>
                    @if(Auth::check())
                    <a href="{{ route('bookings.my') }}" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700">
                        My Bookings
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    @media print {
        .no-print { display: none; }
        body { margin: 0; }
    }
</style>
@endpush
