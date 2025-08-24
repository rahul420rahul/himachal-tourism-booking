<?php
// app/Http/Controllers/Api/V1/BookingController.php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class BookingController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $cacheKey = 'bookings_' . md5($request->getQueryString());
        
        $bookings = Cache::remember($cacheKey, 300, function () use ($request) {
            return Booking::with(['package:id,name,price', 'user:id,name'])
                ->when($request->status, fn($q, $status) => $q->where('status', $status))
                ->when($request->user_id, fn($q, $userId) => $q->forUser($userId))
                ->latest()
                ->paginate(15);
        });

        return response()->json($bookings);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|min:10|max:15',
            'package_id' => 'required|exists:packages,id',
            'booking_date' => 'required|date|after:today',
            'notes' => 'nullable|string|max:1000',
        ]);

        try {
            $booking = Booking::create($validated + [
                'user_id' => auth()->id(),
                'status' => 'pending',
            ]);

            // Clear cache
            Cache::forget('bookings_*');

            return response()->json([
                'message' => 'Booking created successfully',
                'data' => $booking->load('package:id,name,price')
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to create booking',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
