<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DataDepartmentResource\Pages;
use App\Filament\Resources\DataDepartmentResource\RelationManagers;
use App\Models\DataDepartment;
use App\Models\DataDivision;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class DataDepartmentResource extends Resource
{
    protected static ?string $model = DataDepartment::class;

    protected static ?int $navigationSort = 3;
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $navigationLabel = 'Data Departemen';
    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->label('Nama Departemen'),
                Select::make('data_division_id')
                    ->options(fn (): array => DataDivision::pluck('name', 'id')->toArray())
                    ->getSearchResultsUsing(fn (string $search): array => DataDivision::where('name', 'like', "%{$search}%")->limit(50)->pluck('name', 'id')->toArray())
                    ->getOptionLabelUsing(fn ($value): ?string => DataDivision::find($value)?->name)
                    ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('division.name'),
                TextColumn::make('name'),
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
            'index' => Pages\ListDataDepartments::route('/'),
            'create' => Pages\CreateDataDepartment::route('/create'),
            'view' => Pages\ViewDataDepartment::route('/{record}'),
            'edit' => Pages\EditDataDepartment::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        // $devision => User::whereHas('role', function ($query) {
        //     $query->where('devisioon')
        // })->get()->pluck('id')

        $user = Auth::user(); // Get the authenticated user
        $userRoleId= $user->role_id;
        $userDivisionId = $user->division_id;
        $userDepartmentId = $user->department_id;

        $where = array();

        if ($userRoleId == 2) {
            $where = [
                ['division_id', $userDivisionId],
                ['department_id', null]
            ];
        }
        
        if ($userRoleId == 3) {
            $where = [
                ['department_id', $userDepartmentId]
            ];
        }

        return parent::getEloquentQuery()->where($where);
    }
}
