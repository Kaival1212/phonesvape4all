<?php

namespace App\Filament\Resources\ProductStoreInventoryResource\Pages;

use App\Filament\Resources\ProductStoreInventoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProductStoreInventories extends ListRecords
{
    protected static string $resource = ProductStoreInventoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
