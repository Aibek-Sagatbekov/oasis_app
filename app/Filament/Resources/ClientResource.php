<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Models\City;
use App\Models\Client;
use App\Models\User;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\Page;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Card::make()->schema([
                    TextInput::make('name')
                        ->label(__('fields.client.name'))
                        ->required(),

                    Select::make('type')
                        ->label(__('fields.client.type.name'))
                        ->options(['COMMERCE' => __('fields.client.type.COMMERCE'), 'GOVERMENTAL' => __('fields.client.type.GOVERMENTAL')]),

                ])->columns(2),

                Card::make()->schema([

                    Select::make('legal_city_id')
                        ->label(__('fields.client.legal_city'))
                        ->options(fn () => City::take(10)->get()->pluck('name', 'id')->toArray())
                        ->getSearchResultsUsing(fn (string $search) => City::where('name', 'LIKE', '%' . $search .  '%')->limit(10)->pluck('name', 'id'))
                        ->getOptionLabelUsing(fn ($value): ?string => City::find($value)?->name)
                        ->searchable()
                        ->searchDebounce(500)
                        ->preload(),



                    TextInput::make('legal_address')
                        ->label(__('fields.client.legal_address')),

                    TextInput::make('IIK')
                        ->label(__('fields.client.IIK')),

                    TextInput::make('BIN')
                        ->label(__('fields.client.BIN')),

                    TextInput::make('BIK')
                        ->label(__('fields.client.BIK')),

                    TextInput::make('BANK')
                        ->label(__('fields.client.BANK')),

                    TextInput::make('KBE')
                        ->label(__('fields.client.KBE')),

                ])->columns(2),


                Card::make()->schema([
                    Select::make('actual_city_id')
                        ->label(__('fields.client.actual_city'))
                        ->options(fn () => City::take(10)->get()->pluck('name', 'id')->toArray())
                        ->getSearchResultsUsing(fn (string $search) => City::where('name', 'LIKE', '%' . $search .  '%')->limit(10)->pluck('name', 'id'))
                        ->getOptionLabelUsing(fn ($value): ?string => City::find($value)?->name)
                        ->searchable()
                        ->searchDebounce(500)
                        ->preload(),
                    TextInput::make('actual_address')
                        ->label(__('fields.client.actual_address')),

                    TextInput::make('manager_name')
                        ->label(__('fields.client.manager_name'))
                        ->hint('<b>Это поле вскоре будет удалено!</b>')
                        ->disabled(),

                    Select::make('manager_id')
                        ->label(__('fields.client.manager.name'))
                        ->options(function (?Model $record) {
                            return User::when(
                                !auth()->user()->isAdmin(),
                                fn ($q) => $q->where('id', auth()->user()->id)
                            )->get()->pluck('name', 'id');
                        })
                        ->default(function (Page $livewire, ?Model $record) {
                            if ($livewire instanceof CreateRecord) {
                                return auth()->user()->id;
                            }
                            return null;
                        })
                        ->disablePlaceholderSelection()
                        ->disabled(function (Page $livewire) {
                            if (auth()->user()->isAdmin()) return false;
                            if ($livewire instanceof CreateRecord) return true;
                            if ($livewire instanceof EditRecord) return true;
                        })
                        ->reactive()
                        ->required(),

                    Textarea::make('contacts')
                        ->label(__('fields.client.contacts'))
                        ->columnSpan(2),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('fields.client.name'))
                    ->toggleable()
                    ->wrap()
                    ->sortable()
                    ->searchable(),

                TextColumn::make('type')
                    ->label(__('fields.client.type.name'))
                    ->enum(['COMMERCE' => __('fields.client.type.COMMERCE'), 'GOVERMENTAL' => __('fields.client.type.GOVERMENTAL')])
                    ->toggleable()
                    ->wrap()
                    ->sortable()
                    ->searchable(),

                TextColumn::make('actual_city.name')
                    ->toggleable()
                    ->wrap()
                    ->sortable()
                    ->searchable()
                    ->label(__('fields.client.actual_city')),
                TextColumn::make('actual_address')
                    ->toggleable()
                    ->wrap()
                    ->sortable()
                    ->searchable()
                    ->label(__('fields.client.actual_address')),


                TextColumn::make('legal_city.name')
                    ->toggleable()
                    ->wrap()
                    ->sortable()
                    ->searchable()
                    ->label(__('fields.client.legal_city')),
                TextColumn::make('legal_address')
                    ->toggleable()
                    ->wrap()
                    ->sortable()
                    ->searchable()
                    ->label(__('fields.client.legal_address')),

                TextColumn::make('IIK')
                    ->toggleable()
                    ->wrap()
                    ->sortable()
                    ->searchable()
                    ->label(__('fields.client.IIK')),
                TextColumn::make('BIN')
                    ->toggleable()
                    ->wrap()
                    ->sortable()
                    ->searchable()
                    ->label(__('fields.client.BIN')),
                TextColumn::make('BIK')
                    ->toggleable()
                    ->wrap()
                    ->sortable()
                    ->searchable()
                    ->label(__('fields.client.BIK')),
                TextColumn::make('BANK')
                    ->toggleable()
                    ->wrap()
                    ->sortable()
                    ->searchable()
                    ->label(__('fields.client.BANK')),
                TextColumn::make('KBE')
                    ->toggleable()
                    ->wrap()
                    ->sortable()
                    ->searchable()
                    ->label(__('fields.client.KBE')),

                TextColumn::make('manager_name')
                    ->toggleable()
                    ->wrap()
                    ->sortable()
                    ->searchable()
                    ->label(__('fields.client.manager_name')),

                TextColumn::make('manager.name')
                    ->searchable(isIndividual: true, isGlobal: true)
                    ->toggleable()
                    ->wrap()
                    ->sortable()
                    ->searchable()
                    ->label(__('fields.client.manager.name')),
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
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
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
        return __('filament.pages.client.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.pages.client.plural_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('filament.navigation.client.plural_label');
    }

    // protected static function getNavigationGroup(): ?string
    // {
    //     return __('filament.navigation.guide.label');
    // }
}
