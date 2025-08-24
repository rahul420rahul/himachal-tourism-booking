<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\BookingController;
use App\Http\Controllers\Api\V1\PackageController;
use App\Http\Controllers\Api\V1\InvoiceController;

// Existing routes
Route::get('/bookings/calendar', [BookingController::class, 'calendarData'])->name('api.bookings.calendar');
Route::get('/customers/search', [BookingController::class, 'searchCustomers'])->name('api.customers.search');
Route::get('/invoices/stats', [InvoiceController::class, 'getStats'])->name('api.invoices.stats');
Route::get('/packages/search', [PackageController::class, 'search'])->name('api.packages.search');
Route::get('/time-slots', [BookingController::class, 'getAvailableTimeSlots'])->name('api.time-slots');
Route::get('/weather-check', [BookingController::class, 'checkWeather'])->name('api.weather-check');

// New v1 routes
Route::prefix('v1')->group(function () {
    Route::get('/packages', [PackageController::class, 'index'])->name('api.v1.packages.index');
    Route::get('/packages/{package}', [PackageController::class, 'show'])->name('api.v1.packages.show');
    
    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('bookings', BookingController::class)->names([
            'index'   => 'api.v1.bookings.index',
            'store'   => 'api.v1.bookings.store',
            'show'    => 'api.v1.bookings.show',
            'update'  => 'api.v1.bookings.update',
            'destroy' => 'api.v1.bookings.destroy',
        ]);
    });
});
