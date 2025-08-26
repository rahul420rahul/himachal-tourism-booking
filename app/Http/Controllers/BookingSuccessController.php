<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingSuccessController extends Controller
{
    public function show($bookingId)
    {
        $booking = Booking::with('package')->findOrFail($bookingId);
        return view('booking-success', compact('booking'));
    }
}
