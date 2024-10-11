<?php

namespace App\Filament\Resources\DataDivisionResource\Pages;

use App\Filament\Resources\DataDivisionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDataDivisions extends ListRecords
{
    protected static string $resource = DataDivisionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
