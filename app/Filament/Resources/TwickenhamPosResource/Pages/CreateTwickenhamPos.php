<?php

namespace App\Filament\Resources\TwickenhamPosResource\Pages;

use App\Filament\Resources\TwickenhamPosResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTwickenhamPos extends CreateRecord
{
    protected static string $resource = TwickenhamPosResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['store_id'] = 1; // Twickenham store ID
        $data['currency'] = 'GBP';
        return $data;
    }
}
