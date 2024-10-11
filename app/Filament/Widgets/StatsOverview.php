<?php

namespace App\Filament\Widgets;

use App\Models\ProkerDataImplementation;
use App\Models\ProkerDataProker;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalProker = ProkerDataProker::where(filterRole())->count();
        $totalImplementation = ProkerDataImplementation::where(filterRole())->count();
        $totalBudged = ProkerDataImplementation::where(filterRole())->sum('budget');

        return [
            Stat::make('Total Program Kerja', $totalProker),
            Stat::make('Total Implementasi', $totalImplementation),
            Stat::make('Total Anggaran', "Rp " . number_format($totalBudged, 2, ",", ".")),
        ];
    }
}
