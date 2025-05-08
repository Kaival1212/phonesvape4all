<?php

namespace App\Filament\Resources\CaterhamPosResource\Pages;

use App\Filament\Resources\CaterhamPosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCaterhamPos extends EditRecord
{
    protected static string $resource = CaterhamPosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
