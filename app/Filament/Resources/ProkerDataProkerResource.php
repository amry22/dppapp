<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProkerDataProkerResource\Pages;
use App\Filament\Resources\ProkerDataProkerResource\RelationManagers;
use App\Filament\Resources\ProkerDataProkerResource\RelationManagers\ProkerDataImplementationRelationManager;
use App\Models\ProkerDataImplementation;
use App\Models\ProkerDataProker;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class ProkerDataProkerResource extends Resource
{
    protected static ?string $model = ProkerDataProker::class;

    protected static ?int $navigationSort = 1;
    protected static ?string $navigationGroup = 'Proker';
    protected static ?string $navigationLabel = 'Program Kerja';
    protected static ?string $navigationIcon = 'heroicon-o-document-chart-bar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Textarea::make('name')->label('Program Kerja')->required()
                ->columnSpan([
                    'sm' => 2,
                    'xl' => 3,
                    '2xl' => 4,
                ]),
                TextInput::make('division')->label('Bidang')->placeholder(Auth::user()->division->name)->readOnly(),
                TextInput::make('department')->label('Departemen')->placeholder(Auth::user()->department->name)->readOnly()->visible(Auth::user()->department_id != null),
                // TextInput::make('departement')->label('Departemen')->default(Auth::user()->division->name)->readOnly()->visible(Auth::user()->department_id != null),
                Select::make('year')
                    ->native(false)
                    ->default(now()->format('Y'))
                    ->options([
                        '2020' => '2020',
                        '2021' => '2021',
                        '2022' => '2022',
                        '2023' => '2023',
                        '2024' => '2024',
                        '2025' => '2025',
                        '2026' => '2026',
                    ])->label('Tahun')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                
                TextColumn::make('name')->label('Program Kerja')->searchable(),
                TextColumn::make('implementation_count')->counts('implementation')->label('Implementasi'),
                TextColumn::make('division.name')->label('Bidang')->badge(),
                TextColumn::make('department.name')->label('Departemen')->badge(),
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
            RelationManagers\ProkerDataImplementationRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProkerDataProkers::route('/'),
            'create' => Pages\CreateProkerDataProker::route('/create'),
            'view' => Pages\ViewProkerDataProker::route('/{record}'),
            'edit' => Pages\EditProkerDataProker::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        // $devision => User::whereHas('role', function ($query) {
        //     $query->where('devisioon')
        // })->get()->pluck('id')

        

        return parent::getEloquentQuery()->where(filterRole());
    }
}
