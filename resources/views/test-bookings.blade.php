@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Test Bookings View</h1>
    
    <p>Total bookings: {{ $bookings->total() }}</p>
    <p>Current page items: {{ $bookings->count() }}</p>
    <p>Auth check: {{ Auth::check() ? 'YES' : 'NO' }}</p>
    <p>User ID: {{ Auth::id() ?? 'NULL' }}</p>
    
    @foreach($bookings as $booking)
        <div class="bg-white rounded-lg shadow-md p-4 mb-4">
            <p>ID: {{ $booking->id }}</p>
            <p>Number: {{ $booking->booking_number }}</p>
            <p>Package: {{ $booking->package->name ?? 'N/A' }}</p>
        </div>
    @endforeach
    
    {{ $bookings->links() }}
</div>
@endsection
