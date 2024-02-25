<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CityResource\Pages;
use App\Filament\Resources\CityResource\RelationManagers;
use App\Models\District;
use App\Models\Area;
use App\Models\City;
use App\Models\State;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CityResource extends Resource
{
    protected static ?string $model = City::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?int $navigationSort = 4;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label(__('fields.city.name'))
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
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('fields.city.name'))
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
            'index' => Pages\ListCities::route('/'),
            // 'create' => Pages\CreateCity::route('/create'),
            // 'edit' => Pages\EditCity::route('/{record}/edit'),
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
        return __('filament.pages.city.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.pages.city.plural_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('filament.navigation.city.plural_label');
    }

    protected static function getNavigationGroup(): ?string
    {
        return __('filament.navigation.state.label');
    }
}
