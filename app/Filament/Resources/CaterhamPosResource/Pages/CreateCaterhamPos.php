<?php

namespace App\Filament\Resources\CaterhamPosResource\Pages;

use App\Filament\Resources\CaterhamPosResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCaterhamPos extends CreateRecord
{
    protected static string $resource = CaterhamPosResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['store_id'] = 2; // Caterham store ID
        $data['currency'] = 'GBP';
        return $data;
    }
}
