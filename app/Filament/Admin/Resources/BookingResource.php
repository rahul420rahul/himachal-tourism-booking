<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\BookingResource\Pages;
use App\Models\Booking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationGroup = 'Booking Management';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Guest Information')
                    ->schema([
                        Forms\Components\TextInput::make('guest_name')
                            ->label('Guest Name')
                            ->required(),
                        Forms\Components\TextInput::make('guest_email')
                            ->label('Guest Email')
                            ->email()
                            ->required(),
                        Forms\Components\TextInput::make('guest_phone')
                            ->label('Guest Phone')
                            ->tel()
                            ->required(),
                    ])->columns(3),

                Forms\Components\Section::make('Payment Details')
                    ->schema([
                        Forms\Components\TextInput::make('package_price')
                            ->label('Package Price')
                            ->numeric()
                            ->prefix('₹')
                            ->disabled(),
                        Forms\Components\TextInput::make('total_amount')
                            ->label('Total Amount')
                            ->numeric()
                            ->prefix('₹')
                            ->disabled(),
                        Forms\Components\TextInput::make('advance_amount')
                            ->label('Advance Paid')
                            ->numeric()
                            ->prefix('₹')
                            ->disabled(),
                        Forms\Components\TextInput::make('pending_amount')
                            ->label('Balance Due')
                            ->numeric()
                            ->prefix('₹')
                            ->disabled(),
                        Forms\Components\Select::make('booking_status')
                            ->options([
                                'confirmed' => 'Confirmed',
                                'pending' => 'Pending',
                                'cancelled' => 'Cancelled'
                            ])
                            ->label('Booking Status'),
                        Forms\Components\Select::make('payment_status')
                            ->options([
                                'paid' => 'Fully Paid',
                                'partial' => 'Advance Paid',
                                'pending' => 'Payment Pending'
                            ])
                            ->label('Payment Status'),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('booking_number')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('guest_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('guest_email'),
                Tables\Columns\TextColumn::make('guest_phone'),
                Tables\Columns\TextColumn::make('package.name')
                    ->label('Package'),
                Tables\Columns\TextColumn::make('booking_date')
                    ->date(),
                Tables\Columns\TextColumn::make('total_amount')
                    ->money('INR')
                    ->label('Total Amount'),
                Tables\Columns\TextColumn::make('advance_amount')
                    ->money('INR')
                    ->label('Advance Paid'),
                Tables\Columns\TextColumn::make('pending_amount')
                    ->money('INR')
                    ->label('Balance Due'),
                Tables\Columns\BadgeColumn::make('payment_status')
                    ->colors([
                        'success' => 'paid',
                        'warning' => 'partial',
                        'danger' => 'pending',
                    ]),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'success' => 'confirmed',
                        'warning' => 'pending',
                        'danger' => 'cancelled',
                    ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'view' => Pages\ViewBooking::route('/{record}'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
