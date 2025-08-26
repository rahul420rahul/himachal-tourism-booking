@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-lg p-8 text-center">
        <div class="mb-6">
            <svg class="w-24 h-24 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        
        <h1 class="text-3xl font-bold mb-4">Booking Confirmed!</h1>
        
        @if(isset($booking))
        <div class="bg-gray-50 rounded p-6 mb-6 text-left">
            <h2 class="font-bold mb-3">Booking Details:</h2>
            <p><strong>Booking ID:</strong> {{ $booking->booking_number }}</p>
            <p><strong>Package:</strong> {{ $booking->package->name ?? 'N/A' }}</p>
            <p><strong>Date:</strong> {{ $booking->booking_date }}</p>
            <p><strong>Time:</strong> {{ $booking->time_slot }}</p>
            <p><strong>Amount Paid:</strong> ₹{{ $booking->total_amount }}</p>
        </div>
        @else
        <p class="text-gray-600 mb-6">Your booking has been confirmed successfully!</p>
        @endif
        
        <p class="text-gray-600 mb-6">Check your email for confirmation details.</p>
        
        <div class="flex gap-4 justify-center">
            <a href="/" class="bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-600">
                Go to Home
            </a>
            <a href="/my-bookings" class="bg-gray-500 text-white px-6 py-3 rounded hover:bg-gray-600">
                View My Bookings
            </a>
        </div>
    </div>
</div>
@endsection
