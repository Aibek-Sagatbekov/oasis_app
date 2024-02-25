<?php

namespace App\Filament\Resources\SubContractResource\Pages;

use App\Filament\Resources\SubContractResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubContracts extends ListRecords
{
    protected static string $resource = SubContractResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
