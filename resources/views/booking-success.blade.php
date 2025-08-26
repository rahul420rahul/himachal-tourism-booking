@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-8">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-lg p-8 text-center">
        <div class="mb-6">
            <svg class="mx-auto h-20 w-20 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        
        <h1 class="text-3xl font-bold text-green-600 mb-4">Booking Successful!</h1>
        
        <div class="bg-gray-50 p-6 rounded-lg text-left mb-6">
            <p class="mb-2"><strong>Booking ID:</strong> {{ $booking->booking_number }}</p>
            <p class="mb-2"><strong>Package:</strong> {{ $booking->package->name }}</p>
            <p class="mb-2"><strong>Date:</strong> {{ date('Y-m-d', strtotime($booking->booking_date)) }}</p>
            <p class="mb-2"><strong>Time:</strong> {{ $booking->time_slot }}</p>
            
            <div class="border-t mt-4 pt-4">
                <p class="mb-2"><strong>Total Amount:</strong> ₹{{ number_format($booking->total_amount ?? $booking->final_amount, 2) }}</p>
                @if($booking->payment_status == 'partial')
                    <p class="text-green-600 mb-2"><strong>Advance Paid:</strong> ₹{{ number_format($booking->advance_amount, 2) }}</p>
                    <p class="text-orange-600"><strong>Balance Due:</strong> ₹{{ number_format($booking->pending_amount, 2) }}</p>
                @else
                    <p class="text-green-600"><strong>Payment Status:</strong> Fully Paid</p>
                @endif
            </div>
        </div>
        
        <p class="text-gray-600 mb-6">Check your email for confirmation details.</p>
        
        <div class="flex justify-center space-x-4">
            <a href="/" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                Go to Home
            </a>
            <a href="/my-bookings" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">
                View My Bookings
            </a>
        </div>
    </div>
</div>
@endsection
