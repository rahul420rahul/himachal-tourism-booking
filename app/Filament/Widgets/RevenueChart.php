<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;

class RevenueChart extends ChartWidget
{
    protected static ?string $heading = 'Revenue Overview';
    
    protected static ?int $sort = 3;
    
    protected static string $color = 'success';
    
    protected int | string | array $columnSpan = 'full';
    
    protected static ?string $maxHeight = '300px';
    
    protected static ?string $pollingInterval = '60s';

    protected function getData(): array
    {
        $startDate = Carbon::now()->subDays(30);
        $endDate = Carbon::now();
        
        $data = [];
        $labels = [];
        
        // Generate data for last 30 days
        for ($date = $startDate->copy(); $date <= $endDate; $date->addDay()) {
            $revenue = Booking::whereDate('created_at', $date)
                ->where('payment_status', 'paid')
                ->sum('final_amount');
                
            $labels[] = $date->format('d M');
            $data[] = $revenue;
        }
        
        return [
            'datasets' => [
                [
                    'label' => 'Daily Revenue (₹)',
                    'data' => $data,
                    'fill' => 'start',
                    'backgroundColor' => 'rgba(34, 197, 94, 0.1)',
                    'borderColor' => 'rgb(34, 197, 94)',
                    'tension' => 0.3,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
    
    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                ],
                'tooltip' => [
                    'callbacks' => [
                        'label' => "
                            function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += '₹' + new Intl.NumberFormat('en-IN').format(context.parsed.y);
                                }
                                return label;
                            }
                        ",
                    ],
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'callback' => "
                            function(value) {
                                return '₹' + new Intl.NumberFormat('en-IN', { 
                                    notation: 'compact',
                                    compactDisplay: 'short' 
                                }).format(value);
                            }
                        ",
                    ],
                ],
            ],
            'maintainAspectRatio' => false,
        ];
    }
}
