<?php

namespace App\Filament\Resources\ProkerDataReportResource\Pages;

use App\Filament\Resources\ProkerDataReportResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProkerDataReport extends EditRecord
{
    protected static string $resource = ProkerDataReportResource::class;
    protected static ?string $title = 'Edit Laporan';

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
