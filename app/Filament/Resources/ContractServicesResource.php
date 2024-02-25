<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContractServicesResource\Pages;
use App\Filament\Resources\ContractServicesResource\RelationManagers;
use App\Models\Client;
use App\Models\Indicator;
use App\Models\Contract;
use App\Models\SubContract;
use App\Models\ContractServices;
use App\Models\Program;
use App\Models\ServiceType;
use App\Models\ProgramType;
use App\Models\State;
use Filament\Forms\Components\Card;
use App\Rules\UniqueContractServicesColumnsTogether;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TagsColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Component;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Validation\ValidationException;
use Closure;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Model;

class ContractServicesResource extends Resource
{
    protected static ?string $model = ContractServices::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?int $navigationSort = 3;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->columns(2)
                    ->schema([

                        Select::make('client_id')
                            ->label(__('fields.contract_service.client.name'))
                            ->options(fn () => Client::take(10)->get()->mapWithKeys(fn ($option) => [$option->getKey() => static::getOptionHTMLTemplate($option)])->toArray())
                            ->getSearchResultsUsing(fn (string $search) => Client::where('name', 'LIKE', '%' . $search .  '%')->limit(10)->pluck('name', 'id'))
                            ->getOptionLabelUsing(fn ($value): ?string => Client::find($value)?->name)
                            ->searchable()
                            ->hint(__('fields.contract_service.client.hint'))
                            ->allowHtml()
                            ->searchDebounce(500)
                            ->reactive(),

                        Select::make('contract_id')
                            ->label(__('fields.contract_service.contract'))
                            ->options(fn (Closure $get) => Contract::when($get('client_id'), fn ($q) => $q->where('client_id', $get('client_id')))->take(10)->get()->pluck('number', 'id'))
                            ->getSearchResultsUsing(fn (string $search, Closure $get) => Contract::where('number', 'LIKE', '%' . $search .  '%')->when($get('client_id'), fn ($q) => $q->where('client_id', $get('client_id')))->limit(10)->pluck('number', 'id'))
                            ->getOptionLabelUsing(fn ($value): ?string => Contract::find($value)?->number)
                            ->searchable()
                            ->searchDebounce(500)
                            ->reactive()
                            ->required()
                            ->rules([
                                function (Closure $get, ?Model $record) {
                                    $exclude_record_id = null;
                                    if ($record and $record?->exists) $exclude_record_id = $record->id;
                                    return new UniqueContractServicesColumnsTogether([
                                        'contract_id'           => $get('contract_id'),
                                        'sub_contract_id'       => $get('sub_contract_id'),
                                        'service_type_id'       => $get('service_type_id'),
                                        'program_id'            => $get('program_id'),
                                        'state_id'              => $get('state_id'),
                                    ], $exclude_record_id);
                                },
                            ]),

                        Select::make('sub_contract_id')
                            ->label(__('fields.contract_service.sub_contract.number'))
                            ->options(function (callable $get) {
                                $contract = Contract::find($get('contract_id'));
                                if (!$contract) return [];
                                return SubContract::where('contract_id', $contract->id)->pluck('number', 'id')->toArray();
                            })
                            ->getSearchResultsUsing(fn (string $search, callable $get) => SubContract::where('number', 'LIKE', '%' . $search .  '%')->where('contract_id', $get('contract_id'))->limit(10)->pluck('number', 'id'))
                            ->getOptionLabelUsing(fn ($value): ?string => SubContract::find($value)?->number)
                            ->searchable()
                            ->searchDebounce(500)
                            ->reactive()
                            ->hidden(fn (callable $get): bool => !$get('contract_id'))
                            ->rules([
                                function (Closure $get, ?Model $record) {
                                    $exclude_record_id = null;
                                    if ($record and $record?->exists) $exclude_record_id = $record->id;
                                    return new UniqueContractServicesColumnsTogether([
                                        'contract_id'           => $get('contract_id'),
                                        'sub_contract_id'       => $get('sub_contract_id'),
                                        'service_type_id'       => $get('service_type_id'),
                                        'program_id'            => $get('program_id'),
                                        'state_id'              => $get('state_id'),
                                    ], $exclude_record_id);
                                },
                            ]),
                    ]),
                Card::make()
                    ->columns(2)
                    ->schema([

                        Select::make('service_type_id')
                            ->label(__('fields.contract_service.services'))
                            ->options(fn () => ServiceType::take(10)->get()->pluck('name', 'id'))
                            ->getSearchResultsUsing(fn (string $search) => ServiceType::where('name', 'LIKE', '%' . $search .  '%')->limit(10)->pluck('name', 'id'))
                            ->getOptionLabelUsing(fn ($value): ?string => ServiceType::find($value)?->name)
                            ->searchable()
                            ->searchDebounce(500)
                            ->reactive()
                            ->required()
                            ->rules([
                                function (Closure $get, ?Model $record) {
                                    $exclude_record_id = null;
                                    if ($record and $record?->exists) $exclude_record_id = $record->id;
                                    return new UniqueContractServicesColumnsTogether([
                                        'contract_id'           => $get('contract_id'),
                                        'sub_contract_id'       => $get('sub_contract_id'),
                                        'service_type_id'       => $get('service_type_id'),
                                        'program_id'            => $get('program_id'),
                                        'state_id'              => $get('state_id'),
                                    ], $exclude_record_id);
                                },
                            ]),

                        Select::make('program_id')
                            ->label(__('fields.contract_service.programs'))
                            ->options(fn () => Program::take(10)->get()->pluck('name', 'id'))
                            ->getSearchResultsUsing(fn (string $search) => Program::where('name', 'LIKE', '%' . $search .  '%')->limit(10)->pluck('name', 'id'))
                            ->getOptionLabelUsing(fn ($value): ?string => Program::find($value)?->name)
                            ->searchable()
                            ->searchDebounce(500)
                            ->reactive()
                            ->rules([
                                function (Closure $get, ?Model $record) {
                                    $exclude_record_id = null;
                                    if ($record and $record?->exists) $exclude_record_id = $record->id;
                                    return new UniqueContractServicesColumnsTogether([
                                        'contract_id'           => $get('contract_id'),
                                        'sub_contract_id'       => $get('sub_contract_id'),
                                        'service_type_id'       => $get('service_type_id'),
                                        'program_id'            => $get('program_id'),
                                        'state_id'              => $get('state_id'),
                                    ], $exclude_record_id);
                                },
                            ]),

                        Select::make('state_id')
                            ->label(__('fields.contract_service.state'))
                            ->options(fn () => State::take(10)->get()->pluck('name', 'id'))
                            ->searchable()
                            ->getSearchResultsUsing(fn (string $search) => State::where('name', 'LIKE', '%' . $search .  '%')->limit(10)->pluck('name', 'id'))
                            ->getOptionLabelUsing(fn ($value): ?string => State::find($value)?->name)
                            ->searchDebounce(500)
                            ->required()
                            ->rules([
                                function (Closure $get, ?Model $record) {
                                    $exclude_record_id = null;
                                    if ($record and $record?->exists) $exclude_record_id = $record->id;
                                    return new UniqueContractServicesColumnsTogether([
                                        'contract_id'           => $get('contract_id'),
                                        'sub_contract_id'       => $get('sub_contract_id'),
                                        'service_type_id'       => $get('service_type_id'),
                                        'program_id'            => $get('program_id'),
                                        'state_id'              => $get('state_id'),
                                    ], $exclude_record_id);
                                },
                            ]),

                        Select::make('indicator_id')
                            ->label(__('fields.contract_service.indicator'))
                            ->options(fn () => Indicator::take(10)->get()->pluck('name', 'id'))
                            ->searchable()
                            ->getSearchResultsUsing(fn (string $search) => Indicator::where('name', 'LIKE', '%' . $search .  '%')->limit(10)->pluck('name', 'id'))
                            ->getOptionLabelUsing(fn ($value): ?string => Indicator::find($value)?->name)
                            ->searchDebounce(500),
                    ]),
                Card::make()->columns(2)->schema([
                    TextInput::make('count')
                        ->label(__('fields.contract_service.count'))
                        ->numeric()
                        ->default(0)
                        ->required(),
                    TextInput::make('amount')
                        ->label(__('fields.contract_service.amount'))
                        ->numeric()
                        ->default(0)
                        ->required(),
                ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('contract.number')
                    ->label(__('fields.contract_service.contract'))
                    ->toggleable()
                    ->wrap()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('sub_contract.number')
                    ->label(__('fields.contract_service.sub_contract.number'))
                    ->toggleable()
                    ->wrap()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('state.name')
                    ->label(__('fields.contract_service.state'))
                    ->toggleable()
                    ->wrap()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('service_type.name')
                    ->label(__('fields.contract_service.services'))
                    ->toggleable()
                    ->wrap()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('program.name')
                    ->label(__('fields.contract_service.programs'))
                    ->toggleable()
                    ->wrap()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('count')
                    ->label(__('fields.contract_service.count'))
                    ->toggleable()
                    ->wrap()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('amount')
                    ->label(__('fields.contract_service.amount'))
                    ->toggleable()
                    ->wrap()
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
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
            'index' => Pages\ListContractServices::route('/'),
            'create' => Pages\CreateContractServices::route('/create'),
            'edit' => Pages\EditContractServices::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return __('filament.pages.contract_service.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.pages.contract_service.plural_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('filament.navigation.contract_service.plural_label');
    }

    // protected static function getNavigationGroup(): ?string
    // {
    //     return __('filament.navigation.state.label');
    // }

    public static function getOptionHTMLTemplate(Model $option): string
    {
        return view('filament::components.select-option-template')
            ->with('value', $option?->name)
            ->with('description', __('fields.client.contract_count', ['contract_count' => $option->contracts->count()]))
            ->render();
    }
}
