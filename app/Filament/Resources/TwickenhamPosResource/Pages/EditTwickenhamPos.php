<?php

namespace App\Filament\Resources\TwickenhamPosResource\Pages;

use App\Filament\Resources\TwickenhamPosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTwickenhamPos extends EditRecord
{
    protected static string $resource = TwickenhamPosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
