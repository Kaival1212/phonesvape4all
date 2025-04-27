<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductStoreInventoryResource\Pages;
use App\Models\ProductStoreInventory;
use App\Models\ProductVariant;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductStoreInventoryResource extends Resource
{
    protected static ?string $model = ProductStoreInventory::class;
    protected static ?string $navigationGroup = 'Catalog';

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Select a Variant directly
                Select::make('product_variant_id')
                ->label('Variant')
                ->required()

                // build id => "variant – product" pairs
                ->options(function () {
                    return ProductVariant::with('product')
                        ->get()
                        ->mapWithKeys(fn ($variant) => [
                            $variant->id => "{$variant->variant_name} – {$variant->product->name}"
                        ]);
                })

                // allow searching through the labels
                ->searchable()
                ->preload(),

                Select::make('store_id')
                    ->relationship('store', 'name')
                    ->required()
                    ->label('Store'),

                TextInput::make('quantity')
                    ->required()
                    ->label('Quantity')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(10000)
                    ->default(0)
                    ->placeholder('Enter quantity'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Show Product name via variant relationship
                TextColumn::make('variant.product.name')
                    ->label('Product')
                    ->sortable()
                    ->searchable(),

                // Variant name
                TextColumn::make('variant.variant_name')
                    ->label('Variant')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('store.name')
                    ->label('Store')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('quantity')
                    ->label('Quantity')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => number_format($state ?? 0, 0, '.', ',')),

                TextColumn::make('created_at')
                    ->label('Created At')
                    ->sortable()
                    ->dateTime()
                    ->formatStateUsing(fn ($state) => $state->format('d/m/Y H:i:s')),

                TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->sortable()
                    ->dateTime()
                    ->formatStateUsing(fn ($state) => $state->format('d/m/Y H:i:s')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListProductStoreInventories::route('/'),
            'create' => Pages\CreateProductStoreInventory::route('/create'),
            'edit'   => Pages\EditProductStoreInventory::route('/{record}/edit'),
        ];
    }
}
