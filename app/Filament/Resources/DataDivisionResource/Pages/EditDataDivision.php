<?php

namespace App\Filament\Resources\DataDivisionResource\Pages;

use App\Filament\Resources\DataDivisionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDataDivision extends EditRecord
{
    protected static string $resource = DataDivisionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
