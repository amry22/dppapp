<?php

namespace App\Filament\Resources\ProkerDataReportResource\Pages;

use App\Filament\Resources\ProkerDataReportResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;

class ListProkerDataReports extends ListRecords
{
    protected static string $resource = ProkerDataReportResource::class;
    protected static ?string $title = 'Data Laporan';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Laporan'),
        ];
    }

    public function getTabs() : array {
        return [
            'Semua' => Tab::make(),
            'Terlaksana' => Tab::make()->modifyQueryUsing(function ($query){
                $query->where('status','Terlaksana');
            }),
            'Kurang Terlaksana' => Tab::make()->modifyQueryUsing(function ($query){
                $query->where('status','Kurang Terlaksana');
            }),
            'Tidak Terlaksana' => Tab::make()->modifyQueryUsing(function ($query){
                $query->where('status','Tidak Terlaksana');
            })
        ];
    }
}
