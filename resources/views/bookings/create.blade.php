@extends('layouts.app')

@section('title', 'Book Your Adventure')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Book Your Paragliding Adventure</h1>
        
        <!-- React Booking Widget -->
        <div id="booking-widget"></div>
    </div>
@endsection

@push('scripts')
    @vite('resources/js/react-app.js')
@endpush
