<?php

namespace App\Filament\Resources\ServiceTypeResource\Pages;

use App\Filament\Resources\NoResource\Widgets\ServiceTypesWidget;
use App\Filament\Resources\ServiceTypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListServiceTypes extends ListRecords
{
    protected static string $resource = ServiceTypeResource::class;
    protected $listeners = ['refreshListServiceTypes' => '$refresh'];
    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()->after(function () {
                $this->emit('updateServiceTypesWidget');
            }),
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            ServiceTypesWidget::class,
        ];
    }
}
