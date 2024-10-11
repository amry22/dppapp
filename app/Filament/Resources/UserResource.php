<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\DataDepartment;
use App\Models\DataDivision;
use App\Models\ItemRoles;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?int $navigationSort = 4;
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $label = 'Data User';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->label('Nama')->required(),
                TextInput::make('email')->label('Email')->email()->required(),
                TextInput::make('password')->label('Password')
                    ->password()
                    ->revealable() 
                    ->dehydrated(fn (?string $state): bool => filled($state))
                    ->required(fn (string $operation): bool => $operation === 'create'),
                Select::make('role_id')->label('Jabatan')
                    ->options(fn (): array => ItemRoles::pluck('name', 'id')->toArray())
                    ->searchable()
                    ->required(),
                Select::make('division_id')->label('Bidang')
                    ->options(fn (): array => DataDivision::pluck('name', 'id')->toArray())
                    ->getSearchResultsUsing(fn (string $search): array => DataDivision::where('name', 'like', "%{$search}%")->limit(50)->pluck('name', 'id')->toArray())
                    ->getOptionLabelUsing(fn ($value): ?string => DataDivision::find($value)?->name)
                    ->searchable(),
                Select::make('department_id')->label('Departemen')
                    ->options(fn (Get $get): array => DataDepartment::where('data_division_id', $get('division_id'))->pluck('name', 'id')->toArray())
                    ->getSearchResultsUsing(fn (string $search, Get $get): array => DataDepartment::where('name', 'like', "%{$search}%")->where('data_division_id', $get('division_id'))->limit(50)->pluck('name', 'id')->toArray())
                    ->getOptionLabelUsing(fn ($value): ?string => DataDepartment::find($value)?->name)
                    ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nama'),
                TextColumn::make('email')->label('Email'),
                TextColumn::make('role.name')->label('Role')->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Admin' => 'success',
                        'Kabid' => 'warning',
                        'Kadep' => 'danger',
                    }
                ),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
