<?php

namespace App\Filament\Resources\EastSheenPosResource\Pages;

use App\Filament\Resources\EastSheenPosResource;
use Filament\Resources\Pages\CreateRecord;

class CreateEastSheenPos extends CreateRecord
{
    protected static string $resource = EastSheenPosResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['store_id'] = 3; // East Sheen store ID
        $data['currency'] = 'GBP';
        return $data;
    }
}
