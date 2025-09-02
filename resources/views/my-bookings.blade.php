@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">My Bookings</h1>
    
    @if($bookings->count() > 0)
        <div class="grid gap-4">
            @foreach($bookings as $booking)
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-xl font-semibold mb-2">
                                {{ $booking->package ? $booking->package->name : 'Package Not Found' }}
                            </h3>
                            <p class="text-gray-600">Booking ID: #{{ $booking->booking_number ?? 'N/A' }}</p>
                            <p class="text-gray-600">Date: {{ $booking->booking_date }}</p>
                            <p class="text-gray-600">Time: {{ $booking->time_slot ?? '10:00 AM' }}</p>
                            <p class="text-gray-600">Total: ₹{{ number_format($booking->total_amount ?? 0, 0) }}</p>
                </div>
                <div class="mt-4">
                    <a href="{{ route('bookings.show', $booking->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        View Full Details
                    </a>
                        </div>
                        <div class="text-right">
                            <span class="inline-block px-3 py-1 text-sm rounded-full 
                                @if($booking->status == 'confirmed') bg-green-100 text-green-800
                                @elseif($booking->status == 'pending') bg-yellow-100 text-yellow-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="mt-6">
            {{ $bookings->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <p class="text-gray-500 text-lg">No bookings found</p>
            <a href="/packages" class="mt-4 inline-block bg-blue-500 text-white px-6 py-3 rounded">
                Browse Packages
            </a>
        </div>
    @endif
</div>
@endsection
