<?php

namespace App\Filament\Resources\RepairBookingResource\Pages;

use App\Filament\Resources\RepairBookingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRepairBookings extends ListRecords
{
    protected static string $resource = RepairBookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
