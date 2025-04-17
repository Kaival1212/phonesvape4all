<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductStoreInventoryResource\Pages;
use App\Filament\Resources\ProductStoreInventoryResource\RelationManagers;
use App\Models\ProductStoreInventory;
use Dom\Text;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductStoreInventoryResource extends Resource
{
    protected static ?string $model = ProductStoreInventory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Select::make('product_id')
                    ->relationship('product', 'name')
                    ->required()
                    ->label('Product'),

                Select::make('store_id')
                    ->relationship('store', 'name')
                    ->required()
                    ->label('Store'),

                Forms\Components\TextInput::make('quantity')
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

                TextColumn::make('product.name')
                    ->label('Product')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('store.name')
                    ->label('Store')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('quantity')
                    ->label('Quantity')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn ($state) => number_format($state, 0, '.', ',')),

                TextColumn::make('created_at')
                    ->label('Created At')
                    ->sortable()
                    ->dateTime()
                    ->formatStateUsing(fn ($state) => $state->format('d/m/Y H:i:s'))
                    ->searchable(),

                TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->sortable()
                    ->dateTime()
                    ->formatStateUsing(fn ($state) => $state->format('d/m/Y H:i:s'))
                    ->searchable(),

            ])
            ->filters([
                //
            ])
            ->actions([
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
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProductStoreInventories::route('/'),
            'create' => Pages\CreateProductStoreInventory::route('/create'),
            'edit' => Pages\EditProductStoreInventory::route('/{record}/edit'),
        ];
    }
}
