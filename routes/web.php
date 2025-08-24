<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

// Root route - home page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Public Package routes
Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');
Route::get('/packages/{package}', [PackageController::class, 'show'])->name('packages.show');

// Weather routes
Route::get('/weather/{city?}', [WeatherController::class, 'getCurrentWeather'])->name('weather.current');
Route::get('/forecast/{city?}', [WeatherController::class, 'getForecast'])->name('weather.forecast');

// PUBLIC BOOKING ROUTES - MUST BE OUTSIDE AUTH MIDDLEWARE
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
Route::get('/bookings/{id}/guest', [BookingController::class, 'guestShow'])->name('bookings.guest');

// Payment routes (accessible to guests)
Route::post('/payments/create-order', [PaymentController::class, 'createOrder'])->name('payments.create-order');
Route::post('/payments/callback', [PaymentController::class, 'handleCallback'])->name('payments.callback');
Route::post('/payments/verify', [PaymentController::class, 'verifyPayment'])->name('payments.verify');
Route::post('/verify-payment', [PaymentController::class, 'verifyPayment'])->name('verify.payment');
Route::post('/payments/failure', [PaymentController::class, 'handleFailure'])->name('payments.failure');
Route::get('/bookings/{booking}/success', [PaymentController::class, 'success'])->name('bookings.success');
Route::post('/payments/callback', [PaymentController::class, 'callback'])->name('payments.callback');

// Contact routes
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// About and Services routes
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/services', [ServiceController::class, 'index'])->name('services');

// Service specific pages
Route::prefix('services')->name('services.')->group(function () {
    Route::get('/tandem-flights', [ServiceController::class, 'tandem'])->name('tandem');
    Route::get('/training-courses', [ServiceController::class, 'training'])->name('training');
    Route::get('/equipment-rental', [ServiceController::class, 'rental'])->name('rental');
    Route::get('/photography', [ServiceController::class, 'photography'])->name('photography');
});

// Gallery
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');

// Static pages
Route::get('/safety', [PageController::class, 'safety'])->name('safety');
Route::get('/privacy-policy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/terms-conditions', [PageController::class, 'terms'])->name('terms');
Route::get('/refund-policy', [PageController::class, 'refund'])->name('refund');

// PUBLIC API Routes (NO AUTH REQUIRED)
Route::prefix('api')->group(function () {
    Route::get('/packages/search', [PackageController::class, 'search'])->name('api.packages.search');
    Route::get('/time-slots', [BookingController::class, 'getAvailableTimeSlots'])->name('api.time-slots');
    Route::get('/weather-check', [BookingController::class, 'checkWeather'])->name('api.weather-check');
});

// CORS preflight requests for payment routes
Route::options('/payments/{any}', function () {
    return response()->json([], 200, [
        'Access-Control-Allow-Origin' => '*',
        'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE, OPTIONS',
        'Access-Control-Allow-Headers' => 'Origin, Content-Type, Accept, Authorization, X-Request-With',
        'Access-Control-Max-Age' => 3600,
    ]);
})->where('any', '.*');

// Protected routes (require authentication)
Route::middleware('auth')->group(function () {
    // Complete payment routes
Route::post('/bookings/{booking}/complete-payment', [PaymentController::class, 'createPaymentOrder'])->name('bookings.complete-payment');
Route::post('/bookings/{booking}/verify-payment', [PaymentController::class, 'verifyPayment'])->name('bookings.verify-payment');
    
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('verified')->name('dashboard');
    
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/settings', [ProfileController::class, 'settings'])->name('settings');
    
    // Authenticated Booking routes
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    Route::get('/my-bookings', [BookingController::class, 'myBookings'])->name('bookings.my');
    Route::patch('/bookings/{booking}', [BookingController::class, 'update'])->name('bookings.update');
    Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
    
    // Invoice Management Routes
    Route::resource('invoices', InvoiceController::class);
    Route::get('invoices/{invoice}/pdf', [InvoiceController::class, 'downloadPdf'])->name('invoices.pdf');
    Route::post('invoices/{invoice}/send', [BookingController::class, 'sendEmail'])->name('invoices.send');
    Route::post('invoices/{invoice}/pay', [InvoiceController::class, 'markAsPaid'])->name('invoices.pay');
    Route::post('invoices/{invoice}/duplicate', [InvoiceController::class, 'duplicate'])->name('invoices.duplicate');
    
    // AUTHENTICATED API Routes
    Route::prefix('api')->group(function () {
        Route::get('/customers/search', [BookingController::class, 'searchCustomers'])->name('api.customers.search');
        Route::get('/bookings/calendar', [BookingController::class, 'calendarData'])->name('api.bookings.calendar');
        Route::get('/invoices/stats', [InvoiceController::class, 'getStats'])->name('api.invoices.stats');
    });
    
    // Admin/Manager only routes
    Route::middleware(['can:manage-system'])->group(function () {
        
        // Package Management
        Route::post('/packages', [PackageController::class, 'store'])->name('packages.store');
        Route::get('/packages/create', [PackageController::class, 'create'])->name('packages.create');
        Route::get('/packages/{package}/edit', [PackageController::class, 'edit'])->name('packages.edit');
        Route::patch('/packages/{package}', [PackageController::class, 'update'])->name('packages.update');
        Route::delete('/packages/{package}', [PackageController::class, 'destroy'])->name('packages.destroy');
        
        // Payment Management
        Route::get('/manage/payments', [PaymentController::class, 'index'])->name('admin.payments.index');
        Route::get('/manage/payments/{payment}', [PaymentController::class, 'show'])->name('admin.payments.show');
        
        // Contact Management
        Route::get('/manage/contacts', [ContactController::class, 'adminIndex'])->name('admin.contacts.index');
        Route::get('/manage/contacts/{contact}', [ContactController::class, 'adminShow'])->name('admin.contacts.show');
        Route::patch('/manage/contacts/{contact}', [ContactController::class, 'markAsRead'])->name('admin.contacts.read');
        Route::delete('/manage/contacts/{contact}', [ContactController::class, 'destroy'])->name('admin.contacts.destroy');
        
        // Service Management
        Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
        Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
        Route::get('/services/{service}/edit', [ServiceController::class, 'edit'])->name('services.edit');
        Route::patch('/services/{service}', [ServiceController::class, 'update'])->name('services.update');
        Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');
        
        // Gallery Management
        Route::post('/gallery', [GalleryController::class, 'store'])->name('gallery.store');
        Route::get('/gallery/create', [GalleryController::class, 'create'])->name('gallery.create');
        Route::get('/gallery/{gallery}/edit', [GalleryController::class, 'edit'])->name('gallery.edit');
        Route::patch('/gallery/{gallery}', [GalleryController::class, 'update'])->name('gallery.update');
        Route::delete('/gallery/{gallery}', [GalleryController::class, 'destroy'])->name('gallery.destroy');
        
        // Reports and Analytics
        Route::get('/manage/reports', function () {
            return view('admin.reports.index');
        })->name('admin.reports');
        
        Route::get('/manage/analytics', function () {
            return view('admin.analytics.index');
        })->name('admin.analytics');
        
        Route::get('/manage/settings', function () {
            return view('admin.settings.index');
        })->name('admin.settings');
    });
});

// Guest Invoice View (Public access with token)
Route::get('/invoices/{invoice}/view/{token}', [InvoiceController::class, 'publicView'])->name('invoices.public');
Route::get('/invoices/{invoice}/download/{token}', [InvoiceController::class, 'publicDownload'])->name('invoices.public.download');

// Health Check Route
Route::get('/health', function () {
    return response()->json([
        'status' => 'OK',
        'timestamp' => now(),
        'app' => config('app.name'),
        'version' => '1.0.0'
    ]);
})->name('health');

// Maintenance Mode Check
Route::get('/maintenance', function () {
    return view('errors.503');
})->name('maintenance');

// Rewards routes
Route::get('/rewards', function () {
    return view('rewards.index');
})->name('rewards');

// Fallback route for 404
Route::fallback(function () {
    return view('errors.404');
});

// Auth routes
require __DIR__.'/auth.php';
// Add this BEFORE the auth routes
Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
