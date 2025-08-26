<?php
use Illuminate\Support\Facades\Route;

// React Booking System - Single Route
Route::get('/booking-new', function() {
    $packages = \App\Models\Package::where('is_active', true)
        ->orderBy('sort_order')
        ->get();
    return view('react-booking-app', compact('packages'));
})->name('booking.new');
