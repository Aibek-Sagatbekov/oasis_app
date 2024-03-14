<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContractResource\Pages;
use App\Models\Client;
use App\Models\User;
use App\Models\Contract;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Fieldset;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\Page;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class ContractResource extends Resource
{
    protected static ?string $model = Contract::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?int $navigationSort = 2;
    public static function form(Form $form): Form
    { 
        return $form
            ->schema([
                Card::make()->columns(2)->schema([

                    TextInput::make('number')
                        ->label(__('fields.contract.number'))
                        ->required(),                        

                    DatePicker::make('date')
                        ->label(__('fields.contract.date'))
                        ->required(),

                    Select::make('type')
                        ->label(__('fields.contract.type.label'))
                        ->options([
                            'local'     => __('fields.contract.type.values.local'),
                            'center'   => __('fields.contract.type.values.center'),
                        ])
                        ->required(),

                    Select::make('client_id')
                        ->label(__('fields.contract.client.name'))
                        ->options(fn () => Client::take(10)->get()->pluck('name', 'id'))
                        ->getSearchResultsUsing(fn (string $search) => Client::where('name', 'LIKE', '%' . $search .  '%')->limit(10)->pluck('name', 'id'))
                        ->getOptionLabelUsing(fn ($value): ?string => Client::find($value)?->name)
                        ->searchable()
                        ->searchDebounce(500)
                        ->required(),


                    DatePicker::make('date_start')
                        ->label(__('fields.contract.date_start'))
                        ->required(),

                    DatePicker::make('date_end')
                        ->label(__('fields.contract.date_end'))
                        ->required(),
                ]),

                Card::make()->schema([

                    Textarea::make('comment')
                        ->rows(3)
                        ->cols(20)
                        ->label(__('fields.contract.comment')),
                ]),
                Card::make()->schema([

                    Select::make('manager_id')
                        ->label(__('fields.contract_service.manager'))
                        ->options(function () {
                            return User::when(
                                !auth()->user()->isAdmin(),
                                fn ($q) => $q->where('id', auth()->user()->id)
                            )->get()->pluck('name', 'id');
                        })
                        ->default(function (Page $livewire) {
                            if ($livewire instanceof CreateRecord) {
                                return auth()->user()->id;
                            }
                            return auth()->user()->id;
                        })
                        ->disablePlaceholderSelection()
                        ->disabled(function (Page $livewire) {
                            if (auth()->user()->isAdmin()) return false;
                            if ($livewire instanceof CreateRecord) return true;
                            if ($livewire instanceof EditRecord) return true;
                        })
                        ->reactive()
                        ->required(), 
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('number')
                    ->label(__('fields.contract.number'))
                    ->toggleable()
                    ->wrap()
                    ->sortable()
                    ->searchable(),

                TextColumn::make('type')
                    ->label(__('fields.contract.type.label'))
                    ->enum([
                        'local'     => __('fields.contract.type.values.local'),
                        'center'   => __('fields.contract.type.values.center'),
                    ])
                    ->toggleable()
                    ->wrap()
                    ->sortable()
                    ->searchable(),

                TextColumn::make('client.name')
                    ->label(__('fields.contract.client.name'))
                    ->toggleable()
                    ->wrap()
                    ->sortable()
                    ->searchable(),

                TextColumn::make('manager.name')
                    ->searchable(isIndividual: true, isGlobal: true)
                    ->label(__('fields.contract.manager.name'))
                    ->toggleable()
                    ->wrap()
                    ->sortable()
                    ->searchable(),

                TextColumn::make('date')
                    ->label(__('fields.contract.date'))
                    ->date(),
                TextColumn::make('date_start')
                    ->label(__('fields.contract.date_start'))
                    ->date(),
                TextColumn::make('date_end')
                    ->label(__('fields.contract.date_end'))
                    ->date(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                Filter::make('client')
                    ->label(__('fields.contract.client.name'))
                    ->form([
                        Select::make('client_id')
                            ->label(__('fields.contract.client.name'))
                            ->options(function () {
                                return Client::pluck('name', 'id')->toArray();
                            })
                            ->getSearchResultsUsing(fn (string $search) => Client::where('name', 'LIKE', '%' . $search .  '%')->limit(10)->pluck('name', 'id'))
                            ->getOptionLabelUsing(fn ($value): ?string => Client::find($value)?->name)
                            ->searchable()
                            ->searchDebounce(500)
                            ->reactive()
                            ->placeholder(__('Выберите контрагента'))
                    ])
                    ->query(function ($query, array $data) {
                        if (isset($data['client_id'])) {
                            $query->where('client_id', $data['client_id']);
                        }
                    }),
                Filter::make('type')
                    ->label(__('fields.contract.type.label'))
                    ->form([
                        Select::make('type')
                            ->label(__('fields.contract.type.label'))
                            ->options([
                                'local' => __('fields.contract.type.values.local'),
                                'center' => __('fields.contract.type.values.center'),
                            ])
                            ->placeholder(__('Выберите тип контракта'))
                    ])
                    ->query(function ($query, array $data) {
                        if (isset($data['type'])) {
                            $query->where('type', $data['type']);
                        }
                    }),
                Filter::make('manager')
                    ->label(__('fields.contract.manager.name'))
                    ->form([
                        Select::make('manager_id')
                            ->label(__('fields.contract.manager.name'))
                            ->options(function () {
                                return User::when(!auth()->user()->isAdmin(), function ($q) {
                                    $q->where('id', auth()->user()->id);
                                })->get()->pluck('name', 'id');
                            })
                            ->getSearchResultsUsing(fn (string $search) => User::where('name', 'LIKE', '%' . $search .  '%')->limit(10)->pluck('name', 'id'))
                            ->getOptionLabelUsing(fn ($value): ?string => User::find($value)?->name)
                            ->searchable()
                            ->searchDebounce(500)
                            ->reactive()
                            ->placeholder(__('Выберите менеджера контракта'))
                    ])
                    ->query(function ($query, array $data) {
                        if (isset($data['manager_id'])) {
                            $query->where('manager_id', $data['manager_id']);
                        }
                    }),
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
                ExportBulkAction::make()
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContracts::route('/'),
            #'create' => Pages\CreateContract::route('/create'),
            #'edit' => Pages\EditContract::route('/{record}/edit'),
            #'export' => Pages\ExportContracts::route('/export'),
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
        return __('filament.pages.contract.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.pages.contract.plural_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('filament.navigation.contract.plural_label');
    }

    // protected static function getNavigationGroup(): ?string
    // {
    //     return __('filament.navigation.guide.label');
    // }
}
