<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProkerDataReportResource\Pages;
use App\Filament\Resources\ProkerDataReportResource\RelationManagers;
use App\Models\ProkerDataImplementation;
use App\Models\ProkerDataProker;
use App\Models\ProkerDataReport;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class ProkerDataReportResource extends Resource
{
    protected static ?string $model = ProkerDataReport::class;

    protected static ?int $navigationSort = 2;
    protected static ?string $navigationGroup = 'Proker';
    protected static ?string $navigationLabel = 'Laporan';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('division_id')->default(Auth::user()->division_id),
                Hidden::make('department_id')->default(Auth::user()->department_id),
                Textarea::make('proker')
                    ->label('Program Kerja')
                    ->autosize()
                    ->placeholder(fn (callable $get) => ProkerDataImplementation::find($get('proker_data_implementations_id'))->proker->name)
                    ->readOnly()->visibleOn('edit'),
                Textarea::make('proker')
                    ->label('Program Kerja')
                    ->placeholder(fn (callable $get) => ProkerDataImplementation::where('id', $get('proker_data_implementations_id'))
                    ->first()->name)->readOnly()->visibleOn('edit'),
                Forms\Components\Select::make('proker_data_id')->label('Program Kerja')->visibleOn('create')
                    ->options(ProkerDataProker::where('division_id', Auth::user()->division_id)->limit('10')->pluck('name', 'id'))
                    ->getSearchResultsUsing(fn (string $search): array => ProkerDataProker::where('division_id', Auth::user()->division_id)->where('name', 'like', "%{$search}%")->limit(10)->pluck('name', 'id')->toArray())
                    ->getOptionLabelUsing(fn ($value): ?string => ProkerDataProker::find($value)?->name)
                    ->searchable()
                    ->reactive()
                    ->required()
                    ->visibleOn('create'),
                Forms\Components\Select::make('proker_data_implementations_id')
                    ->options(fn (callable $get): array => ProkerDataImplementation::where('proker_data_prokers_id', $get('proker_data_id'))->doesntHave('report')->limit('10')->pluck('name', 'id')->toArray())
                    ->getSearchResultsUsing(fn (string $search): array => ProkerDataImplementation::where('name', 'like', "%{$search}%")->doesntHave('report')->limit(10)->pluck('name', 'id')->toArray())
                    ->getOptionLabelUsing(fn ($value): ?string => ProkerDataImplementation::find($value)?->name)
                    ->searchable()
                    ->visibleOn('create')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        'Terlaksana'=>'Terlaksana',
                        'Kurang Terlaksana'=>'Kurang Terlaksana',
                        'Tidak Terlaksana'=>'Tidak Terlaksana'
                    ])
                    ->native(false)
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('follow_up')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                
                Tables\Columns\TextColumn::make('implementation.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('implementation.proker.name') 
                    ->sortable()
                    ->badge()
                    ->color('info')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Terlaksana' => 'success',
                        'Kurang Terlaksana' => 'warning',
                        'Tidak Terlaksana' => 'danger',
                    }
                ),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('follow_up')
                    ->searchable(),
            ])
            ->filters([
                Filter::make('proker')
                ->form([
                    Select::make('proker_data_implementations_id')->label('Program Kerja')
                        ->options(fn (): array => ProkerDataProker::limit('10')->pluck('name', 'id')->toArray())
                        ->getSearchResultsUsing(fn (string $search): array => ProkerDataProker::where('name', 'like', "%{$search}%")->limit(10)->pluck('name', 'id')->toArray())
                        ->getOptionLabelUsing(fn ($value): ?string => ProkerDataProker::find($value)?->name)
                        ->searchable(),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['proker_data_implementations_id'],
                            fn (Builder $query, $id): Builder => $query->whereRelation('implementation.proker', 'id', $id),
                        );
                })
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
            'index' => Pages\ListProkerDataReports::route('/'),
            'create' => Pages\CreateProkerDataReport::route('/create'),
            'view' => Pages\ViewProkerDataReport::route('/{record}'),
            'edit' => Pages\EditProkerDataReport::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {    
        return parent::getEloquentQuery()->where(filterRole());
    }
}
