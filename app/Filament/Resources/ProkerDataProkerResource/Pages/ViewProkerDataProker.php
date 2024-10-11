<?php

namespace App\Filament\Resources\ProkerDataProkerResource\Pages;

use App\Filament\Resources\ProkerDataProkerResource;
use Filament\Tables\Table;
use Filament\Actions;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\ViewRecord;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;

class ViewProkerDataProker extends ViewRecord
{
    protected static string $resource = ProkerDataProkerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    
}


