<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use App\Models\Package;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;

class BookingStats extends BaseWidget
{
    protected static ?int $sort = 1;
    
    protected function getStats(): array
    {
        // Calculate statistics
        $totalRevenue = Booking::where('payment_status', 'paid')
            ->sum('final_amount') ?? 0;
            
        $todayBookings = Booking::whereDate('created_at', Carbon::today())
            ->count();
            
        $pendingBookings = Booking::where('status', 'pending')
            ->count();
            
        $activePackages = Package::where('is_active', true)
            ->count();
            
        // Monthly revenue calculation
        $lastMonthRevenue = Booking::where('payment_status', 'paid')
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->sum('final_amount') ?? 0;
            
        $currentMonthRevenue = Booking::where('payment_status', 'paid')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('final_amount') ?? 0;
            
        $revenueGrowth = $lastMonthRevenue > 0 
            ? round((($currentMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100, 1)
            : 0;
            
        // Today's earnings
        $todayEarnings = Booking::where('payment_status', 'paid')
            ->whereDate('paid_at', Carbon::today())
            ->sum('final_amount') ?? 0;
            
        return [
            Stat::make('Total Revenue', '₹' . number_format($totalRevenue))
                ->description($revenueGrowth > 0 ? $revenueGrowth . '% increase' : 'Total earnings')
                ->descriptionIcon($revenueGrowth > 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-currency-rupee')
                ->color('success')
                ->chart([7, 3, 4, 5, 6, 8, 10]),
                
            Stat::make('Today\'s Bookings', $todayBookings)
                ->description('₹' . number_format($todayEarnings) . ' earned today')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('info'),
                
            Stat::make('Pending Bookings', $pendingBookings)
                ->description('Awaiting confirmation')
                ->descriptionIcon('heroicon-m-clock')
                ->color($pendingBookings > 5 ? 'warning' : 'gray'),
                
            Stat::make('Active Packages', $activePackages)
                ->description('Available for booking')
                ->descriptionIcon('heroicon-m-gift')
                ->color('primary'),
        ];
    }
}
