<?php

namespace App\Filament\Resources\EastSheenPosResource\Pages;

use App\Filament\Resources\EastSheenPosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEastSheenPos extends EditRecord
{
    protected static string $resource = EastSheenPosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
