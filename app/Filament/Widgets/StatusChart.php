<?php

namespace App\Filament\Widgets;

use App\Models\ProkerDataImplementation;
use App\Models\ProkerDataReport;
use Filament\Widgets\ChartWidget;

class StatusChart extends ChartWidget
{
    protected static ?string $heading = 'Status Implementasi';

    protected function getData(): array
    {
        $statusTerlaksana = ProkerDataReport::where(filterRole())->where('status','Terlaksana')->count();
        $statusKurangTerlaksana = ProkerDataReport::where(filterRole())->where('status','Kurang Terlaksana')->count();
        $statusTidakTerlaksana = ProkerDataReport::where(filterRole())->where('status','Tidak Terlaksana')->count();

        return [
           
            

            'datasets' => [
            [
                'data' => [$statusTerlaksana, $statusKurangTerlaksana, $statusTidakTerlaksana],
                'backgroundColor' => ['rgb(255, 205, 86)', 'rgb(54, 162, 235)','rgb(255, 99, 132)' ],
                'borderColor' => '#9BD0F5',
            ],
        ],
        'labels' => ['Terlaksana', 'Kurang Terlaksana', 'Tidak Terlaksana'],
        
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
