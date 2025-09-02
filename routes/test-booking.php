<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/force-login-bookings', function() {
    // Force login as user ID 1
    Auth::loginUsingId(1);
    
    // Get bookings
    $bookings = Auth::user()->bookings()->with('package')->latest()->paginate(10);
    
    // Pass to view
    return view('my-bookings', compact('bookings'));
});
