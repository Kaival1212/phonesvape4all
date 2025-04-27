<?php

namespace App\Filament\Resources\SellBookingResource\Pages;

use App\Filament\Resources\SellBookingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSellBooking extends EditRecord
{
    protected static string $resource = SellBookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
