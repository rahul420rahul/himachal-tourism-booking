@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-3xl font-bold mb-2">Booking Details</h1>
                    <p class="text-gray-600">Booking ID: #{{ $booking->booking_number }}</p>
                </div>
                <span class="px-4 py-2 rounded-full text-sm font-semibold
                    @if($booking->status == 'confirmed') bg-green-100 text-green-800
                    @elseif($booking->status == 'pending') bg-yellow-100 text-yellow-800
                    @elseif($booking->status == 'cancelled') bg-red-100 text-red-800
                    @else bg-gray-100 text-gray-800
                    @endif">
                    {{ ucfirst($booking->status) }}
                </span>
            </div>
        </div>

        <!-- Package Info -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <h2 class="text-xl font-bold mb-4">Package Information</h2>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <p class="text-gray-600">Package Name</p>
                    <p class="font-semibold">{{ $booking->package->name ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Booking Date</p>
                    <p class="font-semibold">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Time Slot</p>
                    <p class="font-semibold">{{ $booking->time_slot ?? '10:00 AM' }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Total Participants</p>
                    <p class="font-semibold">{{ $booking->participants ?? 1 }} Person(s)</p>
                </div>
            </div>
        </div>

        <!-- Guest Info -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <h2 class="text-xl font-bold mb-4">Guest Information</h2>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <p class="text-gray-600">Name</p>
                    <p class="font-semibold">{{ $booking->guest_name }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Email</p>
                    <p class="font-semibold">{{ $booking->guest_email }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Phone</p>
                    <p class="font-semibold">{{ $booking->guest_phone }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Special Requests</p>
                    <p class="font-semibold">{{ $booking->special_requests ?: 'None' }}</p>
                </div>
            </div>
        </div>

        <!-- Payment Details -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <h2 class="text-xl font-bold mb-4">Payment Information</h2>
            <div class="space-y-3">
                <div class="flex justify-between py-2 border-b">
                    <span class="text-gray-600">Package Price</span>
                    <span class="font-semibold">₹{{ number_format($booking->package_price ?? 0, 2) }}</span>
                </div>
                <div class="flex justify-between py-2 border-b">
                    <span class="text-gray-600">Number of People</span>
                    <span class="font-semibold">{{ $booking->participants ?? 1 }}</span>
                </div>
                <div class="flex justify-between py-2 border-b">
                    <span class="text-gray-600">Total Amount</span>
                    <span class="font-bold text-lg">₹{{ number_format($booking->total_amount ?? 0, 2) }}</span>
                </div>
                
                @if($booking->advance_amount > 0)
                <div class="flex justify-between py-2 border-b">
                    <span class="text-gray-600">Advance Paid</span>
                    <span class="font-semibold text-green-600">₹{{ number_format($booking->advance_amount, 2) }}</span>
                </div>
                @endif
                
                @if($booking->pending_amount > 0)
                <div class="flex justify-between py-2 border-b">
                    <span class="text-gray-600">Balance Due</span>
                    <span class="font-semibold text-orange-600">₹{{ number_format($booking->pending_amount, 2) }}</span>
                </div>
                @endif
                
                <div class="flex justify-between py-2">
                    <span class="text-gray-600">Payment Status</span>
                    <span class="px-3 py-1 rounded-full text-sm font-semibold
                        @if($booking->payment_status == 'paid') bg-green-100 text-green-800
                        @elseif($booking->payment_status == 'partial') bg-yellow-100 text-yellow-800
                        @else bg-red-100 text-red-800
                        @endif">
                        {{ ucfirst($booking->payment_status ?? 'pending') }}
                    </span>
                </div>
                
                @if($booking->razorpay_payment_id)
                <div class="flex justify-between py-2">
                    <span class="text-gray-600">Transaction ID</span>
                    <span class="font-mono text-sm">{{ $booking->razorpay_payment_id }}</span>
                </div>
                @endif
            </div>
        </div>

        <!-- Actions -->
        <div class="flex gap-4">
            <a href="{{ route('bookings.my') }}" class="bg-gray-500 text-white px-6 py-3 rounded hover:bg-gray-600">
                Back to My Bookings
            </a>
            
            @if($booking->pending_amount > 0 && $booking->status != 'cancelled')
            <a href="#" class="bg-orange-500 text-white px-6 py-3 rounded hover:bg-orange-600">
            @if($booking->balance_confirmed)
            <div class="bg-green-100 text-green-800 px-6 py-3 rounded">
                ✓ Full Payment Confirmed
            </div>
            @else
                Pay Balance (₹{{ number_format($booking->pending_amount, 2) }})
            @endif
            </a>
            @endif
            
            <button onclick="window.print()" class="bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-600">
                Print/Download
            </button>
        </div>
    </div>
</div>

<!-- Print Styles -->
<style>
@media print {
    .no-print { display: none; }
    body { font-size: 12pt; }
}
</style>
@endsection
