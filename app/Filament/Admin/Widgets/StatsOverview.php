<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\User;
use App\Models\Package;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalBookings = Booking::count();
        $confirmedBookings = Booking::where('status', 'confirmed')->count();
        $totalRevenue = Payment::where('status', 'success')->sum('amount') ?? 0;
        $totalUsers = User::where('role', 'user')->count();
        $totalPackages = Package::count();
        $pendingBookings = Booking::where('status', 'pending')->count();
        
        // Today's stats
        $todayBookings = Booking::whereDate('created_at', today())->count();
        $todayRevenue = Payment::whereDate('created_at', today())
            ->where('status', 'success')
            ->sum('amount') ?? 0;
        
        // This month stats
        $monthlyRevenue = Payment::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->where('status', 'success')
            ->sum('amount') ?? 0;

        return [
            Stat::make('Total Bookings', $totalBookings)
                ->description($todayBookings . ' bookings today')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
                
            Stat::make('Total Revenue', '₹' . number_format($totalRevenue, 2))
                ->description('₹' . number_format($todayRevenue, 2) . ' today')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
                
            Stat::make('Active Users', $totalUsers)
                ->description('Registered users')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('info'),
                
            Stat::make('Confirmed Bookings', $confirmedBookings)
                ->description($pendingBookings . ' pending')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('warning'),
                
            Stat::make('Monthly Revenue', '₹' . number_format($monthlyRevenue, 2))
                ->description('This month')
                ->descriptionIcon('heroicon-m-currency-rupee')
                ->color('primary'),
                
            Stat::make('Total Packages', $totalPackages)
                ->description('Active packages')
                ->descriptionIcon('heroicon-m-rectangle-stack')
                ->color('gray'),
        ];
    }
}
