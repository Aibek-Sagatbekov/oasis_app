<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubContractResource\Pages;
use App\Filament\Resources\SubContractResource\RelationManagers;
use App\Models\Contract;
use App\Models\SubContract;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SubContractResource extends Resource
{
    protected static ?string $model = SubContract::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?int $navigationSort = 2;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->columns(2)->schema([

                    TextInput::make('number')
                        ->label(__('fields.sub_contract.number'))
                        ->required(),

                    Select::make('contract_id')
                        ->label(__('fields.sub_contract.contract.number'))
                        ->options(fn () => Contract::take(10)->get()->pluck('number', 'id'))
                        ->getSearchResultsUsing(fn (string $search) => Contract::where('number', 'LIKE', '%' . $search .  '%')->limit(10)->pluck('name', 'id'))
                        ->getOptionLabelUsing(fn ($value): ?string => Contract::find($value)?->name)
                        ->searchable()
                        ->searchDebounce(500)
                        ->required(),


                    DatePicker::make('date_start')
                        ->label(__('fields.sub_contract.date_start'))
                        ->required(),

                    DatePicker::make('date_end')
                        ->label(__('fields.sub_contract.date_end'))
                        ->required(),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('number')
                    ->label(__('fields.sub_contract.number'))
                    ->toggleable()
                    ->wrap()
                    ->sortable()
                    ->searchable(),

                TextColumn::make('contract.number')
                    ->label(__('fields.sub_contract.contract.number'))
                    ->toggleable()
                    ->wrap()
                    ->sortable()
                    ->searchable(),

                TextColumn::make('date_start')
                    ->label(__('fields.sub_contract.date_start'))
                    ->date(),
                TextColumn::make('date_end')
                    ->label(__('fields.sub_contract.date_end'))
                    ->date(),

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
            'index' => Pages\ListSubContracts::route('/'),
            'create' => Pages\CreateSubContract::route('/create'),
            'edit' => Pages\EditSubContract::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return __('filament.pages.sub_contract.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.pages.sub_contract.plural_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('filament.navigation.sub_contract.plural_label');
    }

    // protected static function getNavigationGroup(): ?string
    // {
    //     return __('filament.navigation.guide.label');
    // }
}
