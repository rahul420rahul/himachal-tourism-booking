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
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\BookingSuccessController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

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
Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');

// React Booking Route - Single definition
Route::get('/booking/{package_id}', function ($package_id) {
    return view('booking.react', ['package_id' => $package_id]);
})->name('booking.show');

// Booking success page - Single definition
Route::get('/booking-success/{id}', [BookingSuccessController::class, 'show'])->name('booking.success');

// REACT BOOKING ROUTE - PROPERLY CONFIGURED
Route::get('/booking-new/{id?}', function ($id = null) {
    $packages = \App\Models\Package::where('is_active', true)->get();
    $selectedPackage = null;
    
    if ($id) {
        $selectedPackage = \App\Models\Package::find($id);
        if (!$selectedPackage) {
            abort(404, 'Package not found');
        }
    }
    
    return view('react-booking', [
        'packages' => $packages,
        'selectedPackage' => $selectedPackage
    ]);
})->name('booking.react');

// Payment routes (accessible to guests)
Route::post('/payments/create-order', [PaymentController::class, 'createOrder'])->name('payments.create-order');
Route::post('/payments/callback', [PaymentController::class, 'handleCallback'])->name('payments.callback');
Route::post('/payments/verify', [PaymentController::class, 'verifyPayment'])->name('payments.verify');
Route::post('/verify-payment', [PaymentController::class, 'verifyPayment'])->name('verify.payment');
Route::post('/payments/failure', [PaymentController::class, 'handleFailure'])->name('payments.failure');

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
    Route::get('/packages', [\App\Http\Controllers\Api\ReactBookingController::class, 'getPackages'] ?? [PackageController::class, 'index']);
    Route::get('/time-slots', [BookingController::class, 'getAvailableTimeSlots'])->name('api.time-slots');
    Route::get('/weather-check', [BookingController::class, 'checkWeather'])->name('api.weather-check');
    
    // Booking API routes
    Route::post('/bookings', [\App\Http\Controllers\Api\BookingController::class, 'store']);
    Route::get('/my-bookings', [\App\Http\Controllers\Api\BookingController::class, 'getMyBookings']);
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
    
    // Main Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Dashboard Sub-routes
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::post('/certificates/store', [DashboardController::class, 'uploadCertificate'])->name('certificates.store');
        Route::get('/certificates', [DashboardController::class, 'certificates'])->name('certificates');
        Route::get('/certificates/{certificate}/download', [DashboardController::class, 'downloadCertificate'])->name('certificate.download');
        Route::get('/gallery', [DashboardController::class, 'gallery'])->name('gallery');
        Route::post('/gallery/upload', [DashboardController::class, 'uploadToGallery'])->name('gallery.upload');
        Route::delete('/gallery/{gallery}', [DashboardController::class, 'deleteGalleryItem'])->name('gallery.delete');
        Route::get('/achievements', [DashboardController::class, 'achievements'])->name('achievements');
        Route::get('/statistics', [DashboardController::class, 'statistics'])->name('statistics');
        
        // Flight Log CRUD Routes
        Route::get('/flight-logs', [DashboardController::class, 'flightLogs'])->name('flight-logs');
        Route::get('/flight-logs/create', [DashboardController::class, 'createFlightLog'])->name('flight-logs.create');
        Route::post('/flight-logs', [DashboardController::class, 'storeFlightLog'])->name('flight-logs.store');
        Route::get('/flight-logs/{flightLog}/edit', [DashboardController::class, 'editFlightLog'])->name('flight-logs.edit');
        Route::put('/flight-logs/{flightLog}', [DashboardController::class, 'updateFlightLog'])->name('flight-logs.update');
        Route::delete('/flight-logs/{flightLog}', [DashboardController::class, 'destroyFlightLog'])->name('flight-logs.destroy');
    });
    
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/settings', [ProfileController::class, 'settings'])->name('settings');
    
    // Authenticated Booking routes
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
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

// My Bookings (authenticated)
Route::get('/my-bookings', [\App\Http\Controllers\BookingController::class, 'myBookings'])->name('bookings.my')->middleware('auth');

// Guest Invoice View (Public access with token)
Route::get('/invoices/{invoice}/view/{token}', [InvoiceController::class, 'publicView'])->name('invoices.public');
Route::get('/invoices/{invoice}/download/{token}', [InvoiceController::class, 'publicDownload'])->name('invoices.public.download');

// Certificate Verification Route (Public)
Route::get('/certificate/verify/{certificate_number}', [CertificateController::class, 'verify'])->name('certificate.verify');

// Health Check Route
Route::get('/health', function () {
    return response()->json([
        'status' => 'OK',
        'timestamp' => now(),
        'app' => config('app.name'),
        'version' => '1.0.0',
        'cache' => Cache::has('health_check'),
        'database' => DB::connection()->getPdo() ? true : false,
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

// Test routes
Route::get('/test', function() { return view('test'); });
Route::get('/test123', function() { return 'Test route works!'; });
Route::get('/test-react', fn() => view('test-react'));
Route::get('/packages-react', fn() => view('react-packages'))->name('packages.react');

// Fallback route for 404
Route::fallback(function () {
    return view('errors.404');
});

// Auth routes
require __DIR__.'/auth.php';

// Include other route files if they exist
if (file_exists(__DIR__.'/web_react_booking.php')) {
    require __DIR__.'/web_react_booking.php';
}
// Add these routes in the dashboard prefix group (after line 128)
Route::post('/certificates/store', [DashboardController::class, 'uploadCertificate'])->name('certificates.store');
