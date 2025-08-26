<?php
// React Booking API Routes (Clean Version)
use App\Http\Controllers\Api\ReactBookingController;
use App\Http\Controllers\PaymentController;

Route::prefix('booking-api')->group(function () {
    // Package routes
    Route::get('/packages', [ReactBookingController::class, 'getPackages']);
    Route::get('/packages/{id}', [ReactBookingController::class, 'getPackageDetails']);
    
    // Booking routes
    Route::post('/create-booking', [ReactBookingController::class, 'createBooking']);
    Route::get('/booking/{id}', [ReactBookingController::class, 'getBookingDetails']);
    Route::get('/time-slots', [ReactBookingController::class, 'getAvailableTimeSlots']);
    
    // Payment routes
    Route::post('/create-payment', [PaymentController::class, 'createOrder']);
    Route::post('/verify-payment', [PaymentController::class, 'verifyPayment']);
});
