<?php

namespace App\Filament\Resources\DebitResource\RelationManagers;

use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Illuminate\Database\Eloquent\Builder;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

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
                TextColumn::make('contract.client.name')
                    ->label(__('fields.contract_service.client.name'))
                    ->searchable(isIndividual: true)                    
                    ->toggleable()
                    ->wrap()
                    ->sortable(),
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
                TextColumn::make('state.name')
                    ->label(__('fields.contract_service.state'))
                    ->searchable(isIndividual: true)
                    ->toggleable()
                    ->wrap()
                    ->sortable(),
                TextColumn::make('service_type.name')
                    ->label(__('fields.contract_service.services'))
                    ->searchable(isIndividual: true)
                    ->toggleable()
                    ->wrap()
                    ->sortable(),
                TextColumn::make('program.name')
                    ->label(__('fields.contract_service.programs'))
                    ->searchable(isIndividual: true)
                    ->toggleable()
                    ->wrap()
                    ->sortable(),
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
                    ->sortable(),

                TextInputColumn::make('pivot.amount')
                    ->type('number')
                    ->label(__('fields.contract_service.amount'))
                    ->disabled(fn (RelationManager $livewire) => $livewire->ownerRecord->status === 'close')
                    ->updateStateUsing(function ($record, $state) {
                        $amount = number_format($state, 2, '.', ''); // Преобразует значение $state в формат decimal(10,2)
                        $sum = number_format($state * $record->pivot->count, 2, '.', ''); // Преобразует сумму в формат decimal(15,2)
                        $record->pivot->update([
                            'amount' => $amount,
                            'sum' => $sum,
                        ]);
                        return $state;
                    })
                    ->toggleable()
                    ->sortable(),
            ])
            ->filters([

            ])
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
                ExportBulkAction::make()
            ]);
    }
    public static function getTitle(): string
    {
        return __('filament.debit.title');
    }
}
