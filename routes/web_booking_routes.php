
// React Booking System (Single Clean Route)
Route::get('/booking-new', function() {
    return view('react-booking-app');
})->name('booking.new');

// Include API routes for React
require __DIR__.'/api_booking.php';

