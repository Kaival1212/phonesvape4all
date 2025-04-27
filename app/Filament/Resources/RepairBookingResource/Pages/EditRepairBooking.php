<?php

namespace App\Filament\Resources\RepairBookingResource\Pages;

use App\Filament\Resources\RepairBookingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRepairBooking extends EditRecord
{
    protected static string $resource = RepairBookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
