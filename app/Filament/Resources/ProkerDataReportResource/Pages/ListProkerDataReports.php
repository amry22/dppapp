<?php

namespace App\Filament\Resources\ProkerDataReportResource\Pages;

use App\Filament\Resources\ProkerDataReportResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProkerDataReports extends ListRecords
{
    protected static string $resource = ProkerDataReportResource::class;
    protected static ?string $title = 'Data Laporan';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
