<?php

namespace App\Filament\Resources\ProkerDataReportResource\Pages;

use App\Filament\Resources\ProkerDataReportResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewProkerDataReport extends ViewRecord
{
    protected static string $resource = ProkerDataReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
