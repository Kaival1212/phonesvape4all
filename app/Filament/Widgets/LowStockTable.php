<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\ProductStoreInventory;
use App\Models\ProductVariant;
use Filament\Tables\Columns\TextColumn;
class LowStockTable extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(
                 ProductStoreInventory::with(['variant.product', 'store'])
                ->where('quantity', '<', 5)
            )
            ->columns([
                TextColumn::make('variant.variant_name')
                ->label('Variant')
                ->searchable(),
            TextColumn::make('store.name')
                ->label('Store')
                ->searchable(),
            TextColumn::make('quantity')
                ->label('Stock')
                ->color('danger')
                ->sortable(),
            ]);
    }
}
