<?php

namespace App\Filament\Resources\EastSheenPosResource\Pages;

use App\Filament\Resources\EastSheenPosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEastSheenPos extends ListRecords
{
    protected static string $resource = EastSheenPosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
