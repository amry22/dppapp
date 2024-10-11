<?php

namespace App\Filament\Resources\DataDivisionResource\Pages;

use App\Filament\Resources\DataDivisionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDataDivision extends ViewRecord
{
    protected static string $resource = DataDivisionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
