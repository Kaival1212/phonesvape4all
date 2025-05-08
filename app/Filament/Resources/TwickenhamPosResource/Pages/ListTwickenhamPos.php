<?php

namespace App\Filament\Resources\TwickenhamPosResource\Pages;

use App\Filament\Resources\TwickenhamPosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTwickenhamPos extends ListRecords
{
    protected static string $resource = TwickenhamPosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
