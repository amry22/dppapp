<?php

namespace App\Filament\Resources\ProkerDataProkerResource\Pages;

use App\Filament\Resources\ProkerDataProkerResource;
use App\Models\DataDivision;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CreateProkerDataProker extends CreateRecord
{

    public $divisionId = 0;

    protected static string $resource = ProkerDataProkerResource::class;
    protected static ?string $title = 'Tambah Program Kerja';

    protected function handleRecordCreation(array $data) : Model {
        return static::getModel()::create([
            'name' => $data['name'],
            'division_id' => Auth::user()->division_id,
            'department_id' => Auth::user()->department_id,
            'year' => $data['year'],
        ]);
    }

    
}
