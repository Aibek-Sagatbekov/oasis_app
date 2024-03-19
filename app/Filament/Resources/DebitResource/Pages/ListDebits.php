<?php

namespace App\Filament\Resources\DebitResource\Pages;

use App\Filament\Resources\DebitResource;
use App\Filament\Pages\Actions\ExportToExcelAction;
use App\Models\Debit;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Filters\Layout;

class ListDebits extends ListRecords
{
    protected static string $resource = DebitResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label(__('filament.debit.period.open'))
                ->icon('heroicon-o-plus')
                ->disabled(function () {
                    return Debit::where('status', 'open')->count() >= 2;
                })
                ->visible(function ($record) {
                    return auth()->user()->can('open_debit');
                }),
        ];
    }


    protected function getTableFiltersLayout(): ?string
    {
        return Layout::AboveContent;
    }

    protected function getTableFiltersFormColumns(): int
    {
        return 1;
    }
    
}
