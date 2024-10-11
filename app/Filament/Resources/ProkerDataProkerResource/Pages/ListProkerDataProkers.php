<?php

namespace App\Filament\Resources\ProkerDataProkerResource\Pages;

use App\Filament\Resources\ProkerDataProkerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProkerDataProkers extends ListRecords
{
    protected static string $resource = ProkerDataProkerResource::class;
    protected static ?string $title = 'Data Program Kerja';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
