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
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('booking_number')
                    ->required(),
                Forms\Components\TextInput::make('guest_name')
                    ->required(),
                Forms\Components\TextInput::make('guest_email')
                    ->email()
                    ->required(),
                Forms\Components\TextInput::make('guest_phone')
                    ->required(),
                Forms\Components\Select::make('package_id')
                    ->relationship('package', 'name')
                    ->required(),
                Forms\Components\DatePicker::make('booking_date')
                    ->required(),
                Forms\Components\TextInput::make('total_amount')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('advance_amount')
                    ->numeric(),
                Forms\Components\TextInput::make('pending_amount')
                    ->numeric(),
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'cancelled' => 'Cancelled',
                    ]),
                Forms\Components\Select::make('payment_status')
                    ->options([
                        'pending' => 'Pending',
                        'partial' => 'Partial',
                        'paid' => 'Paid',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('booking_number')
                    ->searchable(),
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
                    ->prefix('₹'),
                Tables\Columns\TextColumn::make('pending_amount')
                    ->label('Balance Due')
                    ->money('INR')
                    ->prefix('₹')
                    ->color(fn ($state) => $state > 0 ? 'danger' : 'success')
                    ->weight(fn ($state) => $state > 0 ? 'bold' : 'normal'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'confirmed',
                        'danger' => 'cancelled',
                    ]),
                Tables\Columns\BadgeColumn::make('payment_status')
                    ->colors([
                        'warning' => 'partial',
                        'success' => 'paid',
                        'danger' => 'pending',
                    ]),
            ])
            ->filters([
                Tables\Filters\Filter::make('pending_balance')
                    ->label('Show Pending Payments Only')
                    ->query(fn ($query) => $query->where('pending_amount', '>', 0)->where('balance_confirmed', false)),
            ])
            ->actions([
                Tables\Actions\Action::make('confirm_payment')
                    ->label('Confirm Payment')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn ($record) => $record->pending_amount > 0 && !$record->balance_confirmed)
                    ->requiresConfirmation()
                    ->modalHeading('Confirm Balance Payment')
                    ->modalDescription('Confirm that balance payment has been received?')
                    ->action(function ($record) {
                        $record->update([
                            'balance_confirmed' => true,
                            'balance_confirmed_at' => now(),
                            'payment_status' => 'paid',
                            'pending_amount' => 0,
                            'confirmed_by' => auth()->id()
                        ]);
                    }),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
