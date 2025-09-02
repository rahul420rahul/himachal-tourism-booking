@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Pending Balance Payments</h1>
    
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left">Booking ID</th>
                    <th class="px-6 py-3 text-left">Guest Name</th>
                    <th class="px-6 py-3 text-left">Balance Due</th>
                    <th class="px-6 py-3 text-left">Status</th>
                    <th class="px-6 py-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                @if($booking->pending_amount > 0)
                <tr class="border-b">
                    <td class="px-6 py-4">{{ $booking->booking_number }}</td>
                    <td class="px-6 py-4">{{ $booking->guest_name }}</td>
                    <td class="px-6 py-4 font-bold">₹{{ number_format($booking->pending_amount, 2) }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded">Pending</span>
                    </td>
                    <td class="px-6 py-4">
                        <form action="{{ route('admin.confirm-payment', $booking->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600"
                                    onclick="return confirm('Confirm balance payment received?')">
                                Confirm Payment
                            </button>
                        </form>
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
