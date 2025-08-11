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
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Root route - home page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Public Package routes
Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');
Route::get('/packages/{package}', [PackageController::class, 'show'])->name('packages.show');

// Weather routes
Route::get('/weather/{city?}', [WeatherController::class, 'getCurrentWeather'])->name('weather.current');
Route::get('/forecast/{city?}', [WeatherController::class, 'getForecast'])->name('weather.forecast');

// Public Booking routes (for guest bookings)
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
Route::get('/bookings/{booking}/guest', [BookingController::class, 'guestShow'])->name('bookings.guest');

// Payment routes (accessible to guests)
Route::post('/payments/create-order', [PaymentController::class, 'createOrder'])->name('payments.create-order');
Route::post('/payments/callback', [PaymentController::class, 'handleCallback'])->name('payments.callback');
Route::post('/payments/verify', [PaymentController::class, 'verifyPayment'])->name('payments.verify');
Route::post('/payments/failure', [PaymentController::class, 'handleFailure'])->name('payments.failure');
Route::get('/bookings/{booking}/success', [PaymentController::class, 'success'])->name('bookings.success');

// Contact routes
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// About and Services routes
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/services', [ServiceController::class, 'index'])->name('services');

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
    
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('verified')->name('dashboard');
    
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Authenticated Booking routes
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    Route::get('/my-bookings', [BookingController::class, 'myBookings'])->name('bookings.my');
    Route::patch('/bookings/{booking}', [BookingController::class, 'update'])->name('bookings.update');
    Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
    
    // Invoice Management Routes
    Route::resource('invoices', InvoiceController::class);
    Route::get('invoices/{invoice}/pdf', [InvoiceController::class, 'downloadPdf'])->name('invoices.pdf');
    Route::post('invoices/{invoice}/send', [InvoiceController::class, 'sendEmail'])->name('invoices.send');
    Route::post('invoices/{invoice}/pay', [InvoiceController::class, 'markAsPaid'])->name('invoices.pay');
    Route::post('invoices/{invoice}/duplicate', [InvoiceController::class, 'duplicate'])->name('invoices.duplicate');
    
    // Admin/Manager only routes
    Route::middleware(['can:manage-system'])->group(function () {
        
        // Package Management
        Route::post('/packages', [PackageController::class, 'store'])->name('packages.store');
        Route::get('/packages/create', [PackageController::class, 'create'])->name('packages.create');
        Route::get('/packages/{package}/edit', [PackageController::class, 'edit'])->name('packages.edit');
        Route::patch('/packages/{package}', [PackageController::class, 'update'])->name('packages.update');
        Route::delete('/packages/{package}', [PackageController::class, 'destroy'])->name('packages.destroy');
        
        // All Bookings Management
        Route::get('/admin/bookings', [BookingController::class, 'index'])->name('admin.bookings.index');
        Route::get('/admin/bookings/{booking}', [BookingController::class, 'adminShow'])->name('admin.bookings.show');
        Route::patch('/admin/bookings/{booking}/status', [BookingController::class, 'updateStatus'])->name('admin.bookings.status');
        
        // Payment Management
        Route::get('/admin/payments', [PaymentController::class, 'index'])->name('admin.payments.index');
        Route::get('/admin/payments/{payment}', [PaymentController::class, 'show'])->name('admin.payments.show');
        
        // Contact Inquiries Management
        Route::get('/admin/contacts', [ContactController::class, 'adminIndex'])->name('admin.contacts.index');
        Route::get('/admin/contacts/{contact}', [ContactController::class, 'adminShow'])->name('admin.contacts.show');
        Route::patch('/admin/contacts/{contact}', [ContactController::class, 'markAsRead'])->name('admin.contacts.read');
        Route::delete('/admin/contacts/{contact}', [ContactController::class, 'destroy'])->name('admin.contacts.destroy');
        
        // Service Management
        Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
        Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
        Route::get('/services/{service}/edit', [ServiceController::class, 'edit'])->name('services.edit');
        Route::patch('/services/{service}', [ServiceController::class, 'update'])->name('services.update');
        Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');
        
        // Reports and Analytics
        Route::get('/admin/reports', function () {
            return view('admin.reports.index');
        })->name('admin.reports');
        
        Route::get('/admin/analytics', function () {
            return view('admin.analytics.index');
        })->name('admin.analytics');
        
        // System Settings
        Route::get('/admin/settings', function () {
            return view('admin.settings.index');
        })->name('admin.settings');
    });
});

// Guest Invoice View (Public access with token)
Route::get('/invoices/{invoice}/view/{token}', [InvoiceController::class, 'publicView'])->name('invoices.public');
Route::get('/invoices/{invoice}/download/{token}', [InvoiceController::class, 'publicDownload'])->name('invoices.public.download');

// API Routes for AJAX calls
Route::prefix('api')->middleware('auth')->group(function () {
    Route::get('/packages/search', [PackageController::class, 'search'])->name('api.packages.search');
    Route::get('/customers/search', [BookingController::class, 'searchCustomers'])->name('api.customers.search');
    Route::get('/bookings/calendar', [BookingController::class, 'calendarData'])->name('api.bookings.calendar');
    Route::get('/invoices/stats', [InvoiceController::class, 'getStats'])->name('api.invoices.stats');
});

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

// Fallback route for 404
Route::fallback(function () {
    return view('errors.404');
});

// Auth routes (Laravel Breeze)
require __DIR__.'/auth.php';
