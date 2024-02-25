<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProgramTypeResource\Pages;
use App\Filament\Resources\ProgramTypeResource\RelationManagers;
use App\Models\ProgramType;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProgramTypeResource extends Resource
{
    protected static ?string $model = ProgramType::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label(__('fields.program_type.name'))
                    ->maxValue(255)
                    ->autofocus()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('fields.program_type.name'))
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
            'index' => Pages\ListProgramTypes::route('/'),
            // 'create' => Pages\CreateProgramType::route('/create'),
            // 'edit' => Pages\EditProgramType::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return __('filament.pages.program_type.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.pages.program_type.plural_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('filament.navigation.program_type.plural_label');
    }

    protected static function getNavigationGroup(): ?string
    {
        return __('filament.navigation.guide.label');
    }
}
