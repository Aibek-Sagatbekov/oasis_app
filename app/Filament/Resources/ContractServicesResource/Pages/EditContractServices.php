<?php

namespace App\Filament\Resources\ContractServicesResource\Pages;

use App\Filament\Resources\ContractServicesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditContractServices extends EditRecord
{
    protected static string $resource = ContractServicesResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
