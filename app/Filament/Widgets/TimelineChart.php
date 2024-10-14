<?php

namespace App\Filament\Widgets;

use App\Models\ProkerDataImplementation;
use App\Models\ProkerDataProker;
use Filament\Widgets\ChartWidget;

class TimelineChart extends ChartWidget
{
    protected static ?string $heading = 'Data Implementasi';
    protected static ?string $Group = 'Master Data';
    protected static ?int $sort = 4;
    protected int | string | array $columnSpan = 'full';
    

    




    protected function getData(): array
    {
        $dataTimeline = ProkerDataImplementation::where(filterRole())->first();

        dd($dataTimeline);

        return [
            'datasets' => [
                [
                    'label' => 'Implementasi',
                    'data' => [0, 10, 5, 2, 21, 32, 45, 74, 65, 45, 77, 89,88],
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#9BD0F5',
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec','Isiden'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
