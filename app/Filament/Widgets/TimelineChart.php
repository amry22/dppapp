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
        $dataTimeline = ProkerDataImplementation::where(filterRole());

        $months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember','Isidentil'];
        $count = [];

        foreach ($months as $key => $data) {
           $count [$key] = ProkerDataImplementation::where(filterRole())->whereJsonContains('timeline',$data)->count();
        }

        // $jan = ProkerDataImplementation::where(filterRole())->whereJsonContains('timeline','Januari')->count();
        // $feb = ProkerDataImplementation::where(filterRole())->whereJsonContains('timeline','Februari')->count();
        // $mar = ProkerDataImplementation::where(filterRole())->whereJsonContains('timeline','Maret')->count();
        // $apr = ProkerDataImplementation::where(filterRole())->whereJsonContains('timeline','April')->count();
        // $mei = ProkerDataImplementation::where(filterRole())->whereJsonContains('timeline','Mei')->count();
        // $jun = ProkerDataImplementation::where(filterRole())->whereJsonContains('timeline','Juni')->count();
        // $jul = ProkerDataImplementation::where(filterRole())->whereJsonContains('timeline','Juli')->count();
        // $agu = ProkerDataImplementation::where(filterRole())->whereJsonContains('timeline','Agustus')->count();
        // $sep = ProkerDataImplementation::where(filterRole())->whereJsonContains('timeline','September')->count();
        // $okt = ProkerDataImplementation::where(filterRole())->whereJsonContains('timeline','Oktober')->count();
        // $nov = ProkerDataImplementation::where(filterRole())->whereJsonContains('timeline','November')->count();
        // $des = ProkerDataImplementation::where(filterRole())->whereJsonContains('timeline','Desember')->count();
        // $isn = ProkerDataImplementation::where(filterRole())->whereJsonContains('timeline','Isidentil')->count();

        // foreach ($dataTimeline as $key => $value) {
        //     $jan= $value->timeline;
        // }

        // dd($count);

        return [
            'datasets' => [
                [
                    'label' => 'Implementasi',
                    'data' => $count,
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
