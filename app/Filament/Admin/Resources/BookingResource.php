<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\BookingResource\Pages;
use App\Models\Booking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    
    protected static ?string $navigationGroup = 'Booking Management';
    
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Booking Information')
                    ->schema([
                        Forms\Components\TextInput::make('booking_number')
                            ->label('Booking Number')
                            ->disabled()
                            ->required(),
                            
                        Forms\Components\Select::make('user_id')
                            ->label('Customer')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload(),
                            
                        Forms\Components\Select::make('package_id')
                            ->label('Package')
                            ->relationship('package', 'name')
                            ->searchable()
                            ->required(),
                            
                        Forms\Components\DatePicker::make('booking_date')
                            ->label('Date')
                            ->required(),
                            
                        Forms\Components\TimePicker::make('time_slot')
                            ->label('Time')
                            ->required(),
                            
                        Forms\Components\TextInput::make('participants')
                            ->numeric()
                            ->required()
                            ->default(1),
                    ])
                    ->columns(3),
                    
                Forms\Components\Section::make('Guest Details')
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
                    ])
                    ->columns(3),
                    
                Forms\Components\Section::make('Payment Details')
                    ->schema([
                        Forms\Components\TextInput::make('package_price')
                            ->label('Package Price')
                            ->prefix('₹')
                            ->numeric()
                            ->disabled()
                            ->default(fn ($record) => $record?->package?->price ?? 0),
                            
                        Forms\Components\TextInput::make('final_amount')
                            ->label('Total Amount')
                            ->prefix('₹')
                            ->numeric()
                            ->disabled()
                            ->helperText('Total amount to be paid'),
                            
                        Forms\Components\TextInput::make('advance_amount')
                            ->label('Advance Paid')
                            ->prefix('₹')
                            ->numeric()
                            ->disabled()
                            ->helperText(fn ($record) => 
                                $record && $record->advance_amount > 0 
                                    ? 'Advance payment received' 
                                    : 'No advance paid yet'
                            ),
                            
                        Forms\Components\TextInput::make('pending_amount')
                            ->label('Balance Due')
                            ->prefix('₹')
                            ->numeric()
                            ->disabled()
                            ->helperText(fn ($record) => 
                                $record && $record->pending_amount > 0 
                                    ? 'Amount to be collected on arrival' 
                                    : 'Fully paid - No balance due'
                            ),
                            
                        Forms\Components\Select::make('status')
                            ->label('Booking Status')
                            ->options([
                                'pending' => 'Pending',
                                'confirmed' => 'Confirmed',
                                'cancelled' => 'Cancelled',
                                'completed' => 'Completed',
                            ])
                            ->required()
                            ->helperText('Current booking status'),
                            
                        Forms\Components\Select::make('payment_status')
                            ->label('Payment Status')
                            ->options([
                                'pending' => 'Pending',
                                'partial' => 'Partial',
                                'paid' => 'Fully Paid',
                                'failed' => 'Failed',
                            ])
                            ->required()
                            ->helperText('Current payment status'),
                    ])
                    ->columns(3),
                    
                Forms\Components\Section::make('Additional Information')
                    ->schema([
                        Forms\Components\Textarea::make('special_requests')
                            ->label('Special Requests')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->collapsed(),
                    
                // Payment Summary Card (only visible in view mode)
                Forms\Components\Section::make('Payment Summary')
                    ->schema([
                        Forms\Components\Placeholder::make('payment_breakdown')
                            ->label('')
                            ->content(function ($record) {
                                if (!$record) return '';
                                
                                $html = '<div class="space-y-2">';
                                $html .= '<div class="flex justify-between"><span>Package Price:</span><strong>₹' . number_format($record->package_price ?? $record->final_amount, 2) . '</strong></div>';
                                $html .= '<div class="flex justify-between"><span>Total Amount:</span><strong>₹' . number_format($record->final_amount, 2) . '</strong></div>';
                                $html .= '<hr class="my-2">';
                                $html .= '<div class="flex justify-between text-success-600"><span>Advance Paid:</span><strong>₹' . number_format($record->advance_amount, 2) . '</strong></div>';
                                $html .= '<div class="flex justify-between text-danger-600"><span>Balance Due:</span><strong>₹' . number_format($record->pending_amount, 2) . '</strong></div>';
                                
                                if ($record->pending_amount <= 0) {
                                    $html .= '<div class="mt-2 p-2 bg-success-50 text-success-700 rounded">✓ Fully Paid</div>';
                                } else {
                                    $html .= '<div class="mt-2 p-2 bg-warning-50 text-warning-700 rounded">⚠ Balance of ₹' . number_format($record->pending_amount, 2) . ' to be collected</div>';
                                }
                                
                                $html .= '</div>';
                                return new \Illuminate\Support\HtmlString($html);
                            })
                    ])
                    ->visible(fn ($livewire) => $livewire instanceof Pages\ViewBooking),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('booking_number')
                    ->label('Booking #')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->weight('bold'),
                    
                Tables\Columns\TextColumn::make('guest_name')
                    ->label('Customer')
                    ->searchable()
                    ->default('—')
                    ->description(fn ($record) => $record->guest_phone ?? ''),
                    
                Tables\Columns\TextColumn::make('package.name')
                    ->label('Package')
                    ->default('Basic Paragliding'),
                    
                Tables\Columns\TextColumn::make('booking_date')
                    ->label('Date')
                    ->date('d M Y')
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('time_slot')
                    ->label('Time')
                    ->default('10:00 AM'),
                    
                Tables\Columns\TextColumn::make('participants')
                    ->label('Pax')
                    ->numeric()
                    ->default(1),
                    
                Tables\Columns\TextColumn::make('final_amount')
                    ->label('Amount')
                    ->money('INR')
                    ->sortable(),
                    
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
                    ])
                    ->formatStateUsing(fn (string $state): string => match($state) {
                        'partial' => 'Partial',
                        'paid' => 'Paid',
                        'pending' => 'Pending',
                        'failed' => 'Failed',
                        default => $state
                    }),
                    
                Tables\Columns\TextColumn::make('advance_amount')
                    ->label('Advance')
                    ->money('INR')
                    ->toggleable()
                    ->description('Paid'),
                    
                Tables\Columns\TextColumn::make('pending_amount')
                    ->label('Balance')
                    ->money('INR')
                    ->toggleable()
                    ->color(fn ($state) => $state > 0 ? 'danger' : 'success')
                    ->description('Due'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'cancelled' => 'Cancelled',
                        'completed' => 'Completed',
                    ]),
                Tables\Filters\SelectFilter::make('payment_status')
                    ->options([
                        'pending' => 'Payment Pending',
                        'partial' => 'Partial Payment',
                        'paid' => 'Fully Paid',
                        'failed' => 'Payment Failed',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->icon('heroicon-m-eye'),
                Tables\Actions\EditAction::make()
                    ->icon('heroicon-m-pencil-square'),
                Tables\Actions\DeleteAction::make()
                    ->icon('heroicon-m-trash'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('No bookings yet')
            ->emptyStateDescription('Once bookings are made, they will appear here.')
            ->emptyStateIcon('heroicon-o-calendar');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
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
    
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'pending')->count() ?: null;
    }
    
    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::where('status', 'pending')->count() > 0 ? 'warning' : null;
    }
    
    public static function canViewAny(): bool
    {
        return true;
    }
    
    public static function canView(Model $record): bool
    {
        return true;
    }
    
    public static function canEdit(Model $record): bool
    {
        return true;
    }
    
    public static function canDelete(Model $record): bool
    {
        return true;
    }
    
    public static function canCreate(): bool
    {
        return true;
    }
}