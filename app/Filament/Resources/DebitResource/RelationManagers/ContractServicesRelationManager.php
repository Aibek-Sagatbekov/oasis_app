<?php

namespace App\Filament\Resources\DebitResource\RelationManagers;

use App\Models\Contract;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\Layout;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;

class ContractServicesRelationManager extends RelationManager
{
    protected static string $relationship = 'contract_services';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('contract.number')
                    ->label(__('fields.contract_service.contract'))
                    ->searchable(isIndividual: true)
                    ->toggleable()
                    ->wrap()
                    ->sortable(),
                TextColumn::make('sub_contract.number')
                    ->label(__('fields.contract_service.sub_contract.number'))
                    ->searchable(isIndividual: true)
                    ->toggleable()
                    ->wrap()
                    ->sortable(),

                TextColumn::make('contract.client.name')
                    ->label(__('fields.contract_service.client.name'))
                    ->searchable(isIndividual: true)
                    ->toggleable()
                    ->wrap()
                    ->sortable(),

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

                TextInputColumn::make('pivot.count')
                    ->type('number')
                    ->label(__('fields.contract_service.count'))
                    ->disabled(fn (RelationManager $livewire) => $livewire->ownerRecord->status === 'close')
                    ->updateStateUsing(function ($record, $state) {
                        $record->pivot->update([
                            'count' => (int)$state,
                            'sum'   => (int)$state * (int)$record->pivot->amount,
                        ]);
                        return $state;
                    })
                    ->toggleable()
                    ->sortable()
                    ->searchable(),

                TextInputColumn::make('pivot.amount')
                    ->type('number')
                    ->label(__('fields.contract_service.amount'))
                    ->disabled(fn (RelationManager $livewire) => $livewire->ownerRecord->status === 'close')
                    ->updateStateUsing(function ($record, $state) {
                        $record->pivot->update([
                            'amount'    => (int)$state,
                            'sum'       => (int)$state * (int)$record->pivot->count,
                        ]);
                        return $state;
                    })
                    ->toggleable()
                    ->sortable()
                    ->searchable(),

                TextColumn::make('pivot.sum')

                    ->money('KZT', true)
                    ->label(__('fields.contract_service.sum'))
                    ->toggleable()
                    ->sortable()
                    ->searchable(),

            ])
            ->filters([])
            ->headerActions([
                // ...
                // Tables\Actions\AttachAction::make()
                //     ->preloadRecordSelect()
            ])
            ->actions([
                // ...
                // Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                // ...
                // Tables\Actions\DetachBulkAction::make(),
            ]);
    }
    public static function getTitle(): string
    {
        return __('filament.debit.title');
    }
}
