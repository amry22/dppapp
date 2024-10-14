<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DataDivisionResource\Pages;
use App\Filament\Resources\DataDivisionResource\RelationManagers;
use App\Models\DataDivision;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DataDivisionResource extends Resource
{
    protected static ?string $model = DataDivision::class;

    protected static ?int $navigationSort = 2;
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $navigationLabel = 'Data Bidang';
    protected static ?string $breadcrumb = 'Bidang';
    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('name')->label('Nama Bidang')->required()
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nama Bidang')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDataDivisions::route('/'),
            'create' => Pages\CreateDataDivision::route('/create'),
            'view' => Pages\ViewDataDivision::route('/{record}'),
            'edit' => Pages\EditDataDivision::route('/{record}/edit'),
        ];
    }
}
