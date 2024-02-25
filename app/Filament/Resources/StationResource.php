<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StationResource\Pages;
use App\Filament\Resources\StationResource\RelationManagers;
use App\Models\Area;
use App\Models\City;
use App\Models\District;
use App\Models\State;
use App\Models\Station;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StationResource extends Resource
{
    protected static ?string $model = Station::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label(__('fields.station.name'))
                    ->maxValue(255)
                    ->autofocus()
                    ->required(),

                Select::make('state_id')
                    ->label(__('fields.state.name'))
                    ->relationship('state', 'name')
                    ->reactive()
                    ->required(),

                Select::make('area_id')
                    ->label(__('fields.area.name'))
                    ->options(function (callable $get) {
                        $state = State::find($get('state_id'));
                        if (!$state) return [];
                        return $state->areas()->pluck('name', 'id')->toArray();
                    })
                    ->reactive()
                    ->disabled(fn (callable $get): bool => !$get('state_id'))
                    ->required(),

                Select::make('district_id')
                    ->label(__('fields.district.name'))
                    ->options(function (callable $get) {
                        $area = Area::find($get('area_id'));
                        if (!$area) return [];
                        return $area->districts()->pluck('name', 'id')->toArray();
                    })
                    ->reactive()
                    ->disabled(fn (callable $get): bool => !$get('area_id'))
                    ->required(),

                Select::make('city_id')
                    ->label(__('fields.city.name'))
                    ->options(function (callable $get) {
                        $dictrict = District::find($get('district_id'));
                        if (!$dictrict) return [];
                        return $dictrict->cities()->pluck('name', 'id')->toArray();
                    })
                    ->reactive()
                    ->disabled(fn (callable $get): bool => !$get('district_id'))
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('fields.station.name'))
                    ->toggleable()
                    ->wrap()
                    ->sortable()
                    ->searchable(),

                TextColumn::make('state.name')
                    ->label(__('fields.state.name'))
                    ->toggleable()
                    ->wrap()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('area.name')
                    ->label(__('fields.area.name'))
                    ->toggleable()
                    ->wrap()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('district.name')
                    ->label(__('fields.district.name'))
                    ->toggleable()
                    ->wrap()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('city.name')
                    ->label(__('fields.city.name'))
                    ->toggleable()
                    ->wrap()
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    // Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\RestoreAction::make(),
                    Tables\Actions\ForceDeleteAction::make(),
                ])
            ])
            ->bulkActions([
                // Tables\Actions\DeleteBulkAction::make(),
                // Tables\Actions\ForceDeleteBulkAction::make(),
                // Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListStations::route('/'),
            // 'create' => Pages\ListStations::route('/create'),
            // 'edit' => Pages\ListStations::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getModelLabel(): string
    {
        return __('filament.pages.station.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.pages.station.plural_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('filament.navigation.station.plural_label');
    }

    protected static function getNavigationGroup(): ?string
    {
        return __('filament.navigation.state.label');
    }
}
