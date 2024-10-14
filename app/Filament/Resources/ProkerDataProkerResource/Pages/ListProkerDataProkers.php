<?php

namespace App\Filament\Resources\ProkerDataProkerResource\Pages;

use App\Filament\Resources\ProkerDataProkerResource;
use App\Models\ProkerDataProker;
use App\Providers\Filament\AdminPanelProvider;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\App;

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
