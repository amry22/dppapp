<?php

namespace App\Filament\Widgets;

use App\Models\ProkerDataImplementation;
use App\Models\ProkerDataProker;
use App\Models\ProkerDataReport;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\ListRecords\Tab;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class StatusImplementation extends BaseWidget
{

    protected int | string | array $columnSpan = 'full';
    protected static ?int $sort = 5;

    

    public function table(Table $table): Table
    {
        return $table
            ->query(
               ProkerDataReport::where(filterRole())
            )
            ->columns([
                TextColumn::make('implementation.name')->label('Implementasi')
                    ->searchable(),
                TextColumn::make('implementation.proker.name') ->label('Program Kerja')
                    ->sortable()
                    ->badge()
                    ->color('info')
                    ->searchable(),
                TextColumn::make('status')->label('Status')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Terlaksana' => 'success',
                        'Kurang Terlaksana' => 'warning',
                        'Tidak Terlaksana' => 'danger',
                    }
                ),
                Tables\Columns\TextColumn::make('description')->label('Keterangan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('follow_up')->label('Rencana Tindak Lanjut')
                    ->searchable(),
            ])
           
            ->actions([
                // Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),
            ])
            ;
    }

    
}
