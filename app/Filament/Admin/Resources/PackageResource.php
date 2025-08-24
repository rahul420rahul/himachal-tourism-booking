<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PackageResource\Pages;
use App\Filament\Admin\Resources\PackageResource\RelationManagers;
use App\Models\Package;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Illuminate\Support\Str;

class PackageResource extends Resource
{
    protected static ?string $model = Package::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift';
    
    protected static ?string $navigationGroup = 'Package Management';
    
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Basic Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                            
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(Package::class, 'slug', ignoreRecord: true)
                            ->disabled(fn (string $operation): bool => $operation === 'edit'),
                            
                        Forms\Components\Select::make('category')
                            ->options([
                                'paragliding' => 'Paragliding',
                                'tandem' => 'Tandem Flying',
                                'course' => 'Training Course',
                                'adventure' => 'Adventure Activity',
                                'trekking' => 'Trekking',
                                'camping' => 'Camping',
                            ])
                            ->required()
                            ->native(false),
                            
                        Forms\Components\Select::make('difficulty_level')
                            ->options([
                                'beginner' => 'Beginner',
                                'intermediate' => 'Intermediate',
                                'advanced' => 'Advanced',
                                'expert' => 'Expert',
                            ])
                            ->native(false),
                            
                        Forms\Components\Textarea::make('short_description')
                            ->maxLength(500)
                            ->rows(2)
                            ->columnSpanFull(),
                            
                        Forms\Components\RichEditor::make('description')
                            ->required()
                            ->columnSpanFull()
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'strike',
                                'heading',
                                'bulletList',
                                'orderedList',
                                'link',
                                'redo',
                                'undo',
                            ]),
                    ])
                    ->columns(2),

                Section::make('Pricing & Capacity')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('price')
                                    ->label('Regular Price')
                                    ->prefix('₹')
                                    ->numeric()
                                    ->required()
                                    ->minValue(0),
                                    
                                Forms\Components\TextInput::make('discount_price')
                                    ->label('Discounted Price')
                                    ->prefix('₹')
                                    ->numeric()
                                    ->minValue(0)
                                    ->lte('price'),
                                    
                                Forms\Components\TextInput::make('advance_payment_percentage')
                                    ->label('Advance Payment %')
                                    ->numeric()
                                    ->suffix('%')
                                    ->default(40)
                                    ->minValue(0)
                                    ->maxValue(100)
                                    ->helperText('Percentage of advance payment required'),
                            ]),
                            
                        Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('duration')
                                    ->label('Duration')
                                    ->placeholder('e.g., 2 hours, 3 days')
                                    ->maxLength(100),
                                    
                                Forms\Components\TextInput::make('max_participants')
                                    ->label('Max Participants')
                                    ->numeric()
                                    ->minValue(1)
                                    ->default(10),
                                    
                                Forms\Components\TextInput::make('max_participants_per_slot')
                                    ->label('Max Per Time Slot')
                                    ->numeric()
                                    ->minValue(1)
                                    ->default(5),
                            ]),
                    ]),

                Section::make('Location & Weather')
                    ->schema([
                        Forms\Components\TextInput::make('location')
                            ->label('Location')
                            ->maxLength(255)
                            ->placeholder('e.g., Bir Billing, Himachal Pradesh'),
                            
                        Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('latitude')
                                    ->label('Latitude')
                                    ->numeric()
                                    ->placeholder('32.0425'),
                                    
                                Forms\Components\TextInput::make('longitude')
                                    ->label('Longitude')
                                    ->numeric()
                                    ->placeholder('76.8943'),
                            ]),
                            
                        Forms\Components\Toggle::make('requires_weather_check')
                            ->label('Weather Dependent')
                            ->helperText('Activity depends on weather conditions')
                            ->default(false),
                            
                        Forms\Components\TagsInput::make('weather_dependency')
                            ->label('Weather Requirements')
                            ->placeholder('Add weather conditions')
                            ->suggestions([
                                'Clear sky',
                                'No rain',
                                'Wind speed < 20 km/h',
                                'Good visibility',
                                'No storms',
                            ])
                            ->visible(fn (Forms\Get $get) => $get('requires_weather_check')),
                    ])
                    ->columns(2),

                Section::make('Time Slots')
                    ->schema([
                        Forms\Components\Repeater::make('available_time_slots')
                            ->label('Available Time Slots')
                            ->schema([
                                Forms\Components\TextInput::make('slot')
                                    ->label('Time Slot')
                                    ->placeholder('e.g., 06:00 AM - 08:00 AM')
                                    ->required(),
                                Forms\Components\TextInput::make('max_bookings')
                                    ->label('Max Bookings')
                                    ->numeric()
                                    ->default(5)
                                    ->minValue(1),
                            ])
                            ->columns(2)
                            ->defaultItems(3)
                            ->collapsible()
                            ->cloneable(),
                    ]),

                Section::make('Inclusions & Exclusions')
                    ->schema([
                        Forms\Components\TagsInput::make('inclusions')
                            ->label('What\'s Included')
                            ->placeholder('Add inclusions')
                            ->suggestions([
                                'Professional instructor',
                                'Safety equipment',
                                'Insurance coverage',
                                'Photos & videos',
                                'Transportation',
                                'Refreshments',
                                'Certificate',
                            ])
                            ->columnSpanFull(),
                            
                        Forms\Components\TagsInput::make('exclusions')
                            ->label('What\'s Not Included')
                            ->placeholder('Add exclusions')
                            ->suggestions([
                                'Personal expenses',
                                'Accommodation',
                                'Meals',
                                'Tips',
                                'Travel insurance',
                            ])
                            ->columnSpanFull(),
                            
                        Forms\Components\Textarea::make('requirements')
                            ->label('Requirements & Instructions')
                            ->rows(3)
                            ->placeholder('Age limit, weight restrictions, what to bring, etc.')
                            ->columnSpanFull(),
                            
                        Forms\Components\Textarea::make('safety_requirements')
                            ->label('Safety Requirements')
                            ->rows(3)
                            ->placeholder('Safety guidelines and requirements')
                            ->columnSpanFull(),
                    ]),

                Section::make('Media')
                    ->schema([
                        Forms\Components\FileUpload::make('featured_image')
                            ->label('Featured Image')
                            ->image()
                            ->directory('packages/featured')
                            ->maxSize(5120)
                            ->optimize('webp')
                            ->columnSpanFull(),
                            
                        Forms\Components\FileUpload::make('gallery_images')
                            ->label('Gallery Images')
                            ->multiple()
                            ->image()
                            ->directory('packages/gallery')
                            ->maxSize(5120)
                            ->maxFiles(10)
                            ->reorderable()
                            ->columnSpanFull(),
                    ]),

                Section::make('Status & Settings')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->helperText('Package is available for booking')
                            ->default(true),
                            
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Display Order')
                            ->numeric()
                            ->default(0)
                            ->minValue(0)
                            ->helperText('Lower numbers appear first'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('featured_image')
                    ->label('Image')
                    ->square()
                    ->size(60),
                    
                Tables\Columns\TextColumn::make('name')
                    ->label('Package Name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->limit(40),
                    
                Tables\Columns\BadgeColumn::make('category')
                    ->colors([
                        'primary' => 'paragliding',
                        'success' => 'tandem',
                        'warning' => 'course',
                        'info' => 'adventure',
                        'gray' => 'trekking',
                        'danger' => 'camping',
                    ]),
                    
                Tables\Columns\TextColumn::make('price')
                    ->label('Price')
                    ->money('INR')
                    ->sortable()
                    ->weight('bold'),
                    
                Tables\Columns\TextColumn::make('discount_price')
                    ->label('Offer Price')
                    ->money('INR')
                    ->sortable()
                    ->color('success')
                    ->weight('bold'),
                    
                Tables\Columns\TextColumn::make('advance_payment_percentage')
                    ->label('Advance %')
                    ->suffix('%')
                    ->alignCenter()
                    ->badge()
                    ->color('warning'),
                    
                Tables\Columns\TextColumn::make('duration')
                    ->label('Duration')
                    ->icon('heroicon-m-clock'),
                    
                Tables\Columns\TextColumn::make('max_participants')
                    ->label('Max Pax')
                    ->numeric()
                    ->alignCenter(),
                    
                Tables\Columns\IconColumn::make('requires_weather_check')
                    ->label('Weather')
                    ->boolean()
                    ->trueIcon('heroicon-o-cloud')
                    ->falseIcon('heroicon-o-sun')
                    ->trueColor('warning')
                    ->falseColor('success'),
                    
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Active')
                    ->onColor('success')
                    ->offColor('danger'),
                    
                Tables\Columns\TextColumn::make('bookings_count')
                    ->label('Bookings')
                    ->counts('bookings')
                    ->badge()
                    ->color('info'),
                    
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Order')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->options([
                        'paragliding' => 'Paragliding',
                        'tandem' => 'Tandem Flying',
                        'course' => 'Training Course',
                        'adventure' => 'Adventure Activity',
                        'trekking' => 'Trekking',
                        'camping' => 'Camping',
                    ])
                    ->multiple(),
                    
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active Status')
                    ->trueLabel('Active Only')
                    ->falseLabel('Inactive Only')
                    ->queries(
                        true: fn (Builder $query) => $query->where('is_active', true),
                        false: fn (Builder $query) => $query->where('is_active', false),
                    ),
                    
                Tables\Filters\TernaryFilter::make('requires_weather_check')
                    ->label('Weather Dependent')
                    ->trueLabel('Weather Dependent')
                    ->falseLabel('Not Weather Dependent'),
                    
                Tables\Filters\Filter::make('price_range')
                    ->form([
                        Forms\Components\TextInput::make('price_from')
                            ->numeric()
                            ->prefix('₹'),
                        Forms\Components\TextInput::make('price_to')
                            ->numeric()
                            ->prefix('₹'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['price_from'],
                                fn (Builder $query, $price): Builder => $query->where('price', '>=', $price),
                            )
                            ->when(
                                $data['price_to'],
                                fn (Builder $query, $price): Builder => $query->where('price', '<=', $price),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->iconButton(),
                    
                Tables\Actions\EditAction::make()
                    ->iconButton(),
                    
                Tables\Actions\Action::make('duplicate')
                    ->label('Duplicate')
                    ->icon('heroicon-o-document-duplicate')
                    ->action(function (Package $record): void {
                        $newPackage = $record->replicate();
                        $newPackage->name = $record->name . ' (Copy)';
                        $newPackage->slug = Str::slug($newPackage->name);
                        $newPackage->is_active = false;
                        $newPackage->save();
                    })
                    ->requiresConfirmation()
                    ->color('gray'),
                    
                Tables\Actions\DeleteAction::make()
                    ->iconButton()
                    ->requiresConfirmation(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    
                    Tables\Actions\BulkAction::make('activate')
                        ->label('Activate')
                        ->icon('heroicon-o-check')
                        ->action(fn ($records) => $records->each->update(['is_active' => true]))
                        ->deselectRecordsAfterCompletion()
                        ->requiresConfirmation()
                        ->color('success'),
                        
                    Tables\Actions\BulkAction::make('deactivate')
                        ->label('Deactivate')
                        ->icon('heroicon-o-x-mark')
                        ->action(fn ($records) => $records->each->update(['is_active' => false]))
                        ->deselectRecordsAfterCompletion()
                        ->requiresConfirmation()
                        ->color('danger'),
                ]),
            ])
            ->reorderable('sort_order')
            ->defaultSort('sort_order', 'asc');
    }

    public static function getRelations(): array
    {
        return [
            // Add BookingsRelationManager if needed
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPackages::route('/'),
            'create' => Pages\CreatePackage::route('/create'),
            'edit' => Pages\EditPackage::route('/{record}/edit'),
            'view' => Pages\ViewPackage::route('/{record}'),
        ];
    }
    
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('is_active', true)->count();
    }
    
    public static function getNavigationBadgeColor(): ?string
    {
        return 'success';
    }
    
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withCount('bookings');
    }
}