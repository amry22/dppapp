<?php

namespace App\Filament\Resources\ProkerDataProkerResource\Pages;

use App\Filament\Resources\ProkerDataProkerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProkerDataProker extends EditRecord
{
    protected static string $resource = ProkerDataProkerResource::class;
    protected static ?string $title = 'Edit Program Kerja';

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
