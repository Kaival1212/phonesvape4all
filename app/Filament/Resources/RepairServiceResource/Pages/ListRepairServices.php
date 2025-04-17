<?php

namespace App\Filament\Resources\RepairServiceResource\Pages;

use App\Filament\Resources\RepairServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRepairServices extends ListRecords
{
    protected static string $resource = RepairServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
