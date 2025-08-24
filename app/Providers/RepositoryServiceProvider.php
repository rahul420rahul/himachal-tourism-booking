<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Eloquent\BookingRepository;
use App\Repositories\Eloquent\PaymentRepository;
use App\Repositories\Eloquent\PackageRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('App\Repositories\Eloquent\BookingRepository', function ($app) {
            return new BookingRepository(new \App\Models\Booking());
        });
    }

    public function boot()
    {
        //
    }
}
