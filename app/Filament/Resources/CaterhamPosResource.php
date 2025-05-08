<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CaterhamPosResource\Pages;
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

class CaterhamPosResource extends Resource
{
    protected static ?string $model = RepairBooking::class;
    protected static ?string $navigationGroup = 'Store POS';
    protected static ?string $navigationIcon = 'heroicon-o-computer-desktop';
    protected static ?string $navigationLabel = 'Caterham POS';
    protected static ?int $navigationSort = 2;

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
                    ->afterStateUpdated(function (
                        $state, Forms\Set $set, Forms\Get $get
                    ) {
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
                    ->afterStateHydrated(function (
                        Forms\Components\Select $component, $state, ?\App\Models\RepairBooking $record
                    ) {
                        if ($record) {
                            $component->state($record->repairServices->pluck('id')->toArray());
                        }
                    })
                    ->saveRelationshipsUsing(function (
                        \App\Models\RepairBooking $record, $state
                    ) {
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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('name'),
                TextColumn::make('created_at'),
                TextColumn::make('updated_at'),
            ])
            ->defaultSort('id');
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
            'index' => Pages\ListCaterhamPos::route('/'),
            'create' => Pages\CreateCaterhamPos::route('/create'),
            'edit' => Pages\EditCaterhamPos::route('/{record}/edit'),
        ];
    }
}
