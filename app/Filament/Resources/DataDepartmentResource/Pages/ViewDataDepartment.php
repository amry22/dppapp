<?php

namespace App\Filament\Resources\DataDepartmentResource\Pages;

use App\Filament\Resources\DataDepartmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDataDepartment extends ViewRecord
{
    protected static string $resource = DataDepartmentResource::class;
    protected static ?string $title = 'Data Departemen';

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
