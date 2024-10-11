<?php

namespace App\Filament\Resources\ProkerDataProkerResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProkerDataImplementationRelationManager extends RelationManager
{
    protected static string $relationship = 'implementation';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->label('Implementasi')
                    ->required()
                    ->maxLength(255),
                TextInput::make('target')->required()->label('Target'),
                Select::make('timeline')->label('Bulan')->options([
                    'Januari' => 'Januari',
                    'Februari' => 'Februari',
                    'Maret' => 'Maret',
                    'April' => 'April',
                    'Mei' => 'Mei',
                    'Juni' => 'Juni',
                    'Juli' => 'Juli',
                    'Agustus' => 'Agustus',
                    'September' => 'September',
                    'Oktober' => 'Oktober',
                    'November' => 'November',
                    'Desember' => 'Desember'
                ])->multiple()->required()->native(false),
                TextInput::make('budget')->label('Anggaran')->numeric()->required(),
                Select::make('budget_source')->label('Sumber Dana')
                    ->options([
                        'Internal' => 'Internal',
                        'External' => 'External',
                    ])
                    ->native(false)->required()
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->heading('Implementasi')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                TextColumn::make('target'),
                TextColumn::make('timeline')->badge(),
                TextColumn::make('budget')->money('Rp. '),
                TextColumn::make('budget_source')->badge()->color(fn (string $state): string => match ($state) {
                    'Internal' => 'info',
                    'External' => 'warning',
                }),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                ->label('Tambah Implementasi')
                ->modalHeading('Tambah Implementasi'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
