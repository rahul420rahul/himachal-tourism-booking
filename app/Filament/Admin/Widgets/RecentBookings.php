<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Booking;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentBookings extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';
    
    protected static ?int $sort = 2;
    
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Booking::query()
                    ->latest()
                    ->limit(5)
            )
        ->columns([
    Tables\Columns\TextColumn::make('booking_number')
        ->label('Booking #')
        ->searchable()
        ->weight('bold'),
        
    Tables\Columns\TextColumn::make('guest_name')
        ->label('Customer')
        ->searchable()
        ->default('—'),
        
    Tables\Columns\TextColumn::make('package.name')
        ->label('Package')
        ->default('Basic Paragliding'),
        
    Tables\Columns\TextColumn::make('booking_date')
        ->date('d M Y'),
        
    Tables\Columns\TextColumn::make('final_amount')
        ->money('INR'),
        
    Tables\Columns\BadgeColumn::make('status')
        ->colors([
            'danger' => 'cancelled',
            'warning' => 'pending',
            'success' => fn ($state) => in_array($state, ['confirmed', 'completed']),
        ]),
        
    Tables\Columns\BadgeColumn::make('payment_status')
        ->label('Payment')
        ->colors([
            'danger' => 'failed',
            'warning' => fn ($state) => in_array($state, ['pending', 'partial']),
            'success' => 'paid',
        ]),
])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->url(fn (Booking $record): string => route('filament.admin.resources.bookings.edit', $record))
                    ->icon('heroicon-m-eye'),
            ])
            ->paginated(false);
    }
}
