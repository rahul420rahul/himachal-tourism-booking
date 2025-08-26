<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TrackBookings
{
    public function handle(Request $request, Closure $next)
    {
        // Initialize booking IDs in session if not exists
        if (!session()->has('my_booking_ids')) {
            session(['my_booking_ids' => []]);
        }
        return $next($request);
    }
}
