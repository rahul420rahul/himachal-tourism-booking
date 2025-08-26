@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Flight Statistics</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="font-semibold">Total Flights</h3>
            <p class="text-2xl">{{ $stats['total_flights'] ?? 0 }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="font-semibold">Total Hours</h3>
            <p class="text-2xl">{{ $stats['total_hours'] ?? 0 }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="font-semibold">Max Altitude</h3>
            <p class="text-2xl">{{ $stats['max_altitude'] ?? 0 }} m</p>
        </div>
    </div>
</div>
@endsection
