<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EastSheenPosResource\Pages;
use App\Models\RepairBooking;
use App\Models\RepairService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Repeater;

class EastSheenPosResource extends Resource
{
    protected static ?string $model = RepairBooking::class;
    protected static ?string $navigationGroup = 'Store POS';
    protected static ?string $navigationIcon = 'heroicon-o-computer-desktop';
    protected static ?string $navigationLabel = 'East Sheen POS';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('product_id')
                    ->relationship('product', 'name')
                    ->label('Product')
                    ->required()
                    ->searchable()
                    ->preload(),

                Forms\Components\Select::make('repair_services')
                    ->multiple()
                    ->relationship('repairServices', 'name')
                    ->preload()
                    ->searchable()
                    ->required()
                    ->label('Repair Services')
                    ->afterStateUpdated(function ($state, Forms\Set $set, Forms\Get $get) {
                        $totalAmount = 0;
                        $totalDiscount = 0;
                        if ($state) {
                            $services = \App\Models\RepairService::whereIn('id', $state)->get();
                            foreach ($services as $service) {
                                $totalAmount += $service->price;
                                $totalDiscount += $service->discount ?? 0;
                            }
                        }
                        $set('total_amount', $totalAmount);
                        $set('total_discount', $totalDiscount);
                        $set('final_amount', $totalAmount - $totalDiscount);
                    })
                    ->afterStateHydrated(function (Forms\Components\Select $component, $state, ?\App\Models\RepairBooking $record) {
                        if ($record) {
                            $component->state($record->repairServices->pluck('id')->toArray());
                        }
                    })
                    ->saveRelationshipsUsing(function (\App\Models\RepairBooking $record, $state) {
                        $record->repairServices()->detach();
                        if ($state) {
                            $services = \App\Models\RepairService::whereIn('id', $state)->get();
                            foreach ($services as $service) {
                                $record->repairServices()->attach($service->id, [
                                    'price' => $service->price,
                                    'discount' => $service->discount,
                                    'total' => $service->price - ($service->discount ?? 0)
                                ]);
                            }
                        }
                    }),

                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Customer Name')
                    ->placeholder('Enter customer name'),

                Forms\Components\TextInput::make('email')
                    ->required()
                    ->label('Customer Email')
                    ->placeholder('Enter customer email')
                    ->email(),

                Forms\Components\TextInput::make('phone')
                    ->required()
                    ->label('Customer Phone')
                    ->placeholder('Enter customer phone'),

                Forms\Components\DatePicker::make('selected_date')
                    ->required()
                    ->label('Service Date')
                    ->default(now())
                    ->placeholder('Enter service date')
                    ->date(),

                Forms\Components\TimePicker::make('selected_time')
                    ->required()
                    ->label('Service Time')
                    ->default(now())
                    ->hoursStep(1)
                    ->seconds(false)
                    ->placeholder('Enter service time')
                    ->time(),

                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'cancelled' => 'Cancelled',
                    ])
                    ->default('confirmed')
                    ->label('Status'),

                Forms\Components\TextInput::make('notes')
                    ->label('Notes')
                    ->placeholder('Enter notes'),

                Forms\Components\Select::make('payment_status')
                    ->options([
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                        'failed' => 'Failed',
                    ])
                    ->default('paid')
                    ->label('Payment Status'),

                Forms\Components\Select::make('payment_method')
                    ->options([
                        'card' => 'Card',
                        'cash' => 'Cash',
                        'bank_transfer' => 'Bank Transfer',
                    ])
                    ->default('cash')
                    ->label('Payment Method'),

                Forms\Components\TextInput::make('total_amount')
                    ->required()
                    ->label('Total Amount')
                    ->placeholder('Enter total amount')
                    ->numeric()
                    ->afterStateUpdated(function ($state, Forms\Set $set, Forms\Get $get) {
                        $totalDiscount = $get('total_discount');
                        $set('final_amount', $state - $totalDiscount);
                    }),

                Forms\Components\TextInput::make('total_discount')
                    ->label('Total Discount')
                    ->placeholder('Enter total discount')
                    ->numeric()
                    ->default(0)
                    ->minValue(0)
                    ->maxValue(fn (Forms\Get $get) => $get('total_amount'))
                    ->afterStateUpdated(function ($state, Forms\Set $set, Forms\Get $get) {
                        $totalAmount = $get('total_amount');
                        $set('final_amount', $totalAmount - $state);
                    }),

                Forms\Components\TextInput::make('final_amount')
                    ->required()
                    ->label('Final Amount')
                    ->placeholder('Enter final amount')
                    ->numeric()
                    ->afterStateUpdated(function ($state, Forms\Set $set, Forms\Get $get) {
                        $totalAmount = $get('total_amount');
                        $totalDiscount = $totalAmount - $state;
                        $set('total_discount', max(0, $totalDiscount));
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('name')
                    ->label('Customer')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('phone')
                    ->label('Phone')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('repairServices.name')
                    ->label('Services')
                    ->listWithLineBreaks()
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('selected_date')
                    ->label('Date')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('selected_time')
                    ->label('Time')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('payment_status')
                    ->label('Payment Status')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('payment_method')
                    ->label('Payment Method')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('total_amount')
                    ->label('Subtotal')
                    ->money('GBP')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('total_discount')
                    ->label('Discount')
                    ->money('GBP')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('final_amount')
                    ->label('Total')
                    ->money('GBP')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->label('Created At')
                    ->sortable()
                    ->dateTime()
                    ->formatStateUsing(fn ($state) => $state->format('d/m/Y H:i:s'))
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('print')
                    ->icon('heroicon-o-printer')
                    ->url(fn (RepairBooking $record): string => route('print.repair-receipt', $record))
                    ->openUrlInNewTab(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEastSheenPos::route('/'),
            'create' => Pages\CreateEastSheenPos::route('/create'),
            'edit' => Pages\EditEastSheenPos::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('store_id', 1); // East Sheen store ID
    }
}
