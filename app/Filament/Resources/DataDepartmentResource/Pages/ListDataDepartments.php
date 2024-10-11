<?php

namespace App\Filament\Resources\DataDepartmentResource\Pages;

use App\Filament\Resources\DataDepartmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDataDepartments extends ListRecords
{
    protected static string $resource = DataDepartmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
