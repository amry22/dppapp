<?php

namespace App\Filament\Resources\ProkerDataProkerResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class ProkerDataImplementationRelationManager extends RelationManager
{
    protected static string $relationship = 'implementation';
    protected static ?string $title = 'Data Implementasi';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                
                Textarea::make('name')->label('Implementasi')
                    ->required()
                    ->maxLength(255),
                Textarea::make('target')->required()->label('Target'),
                Select::make('timeline')->label('Bulan')->options([
                    'Isidentil' => 'Isidentil',
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
                        'APBO' => 'APBO',
                        'BMH' => 'BMH',
                        'BUMO' => 'BUMO',
                        'DPW' => 'DPW',
                        'DPD' => 'DPD',
                        'External' => 'External',
                    ])->multiple()->required()->native(false)
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->heading('')
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Implementasi'),
                TextColumn::make('target')->label('Target'),
                TextColumn::make('timeline')->badge()->label('Bulan'),
                TextColumn::make('budget')->money('Rp. ')->label('Anggaran'),
                TextColumn::make('budget_source')->badge()->label('Sumber Dana'),
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
