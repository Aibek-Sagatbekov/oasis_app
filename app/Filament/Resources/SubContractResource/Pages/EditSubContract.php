<?php

namespace App\Filament\Resources\SubContractResource\Pages;

use App\Filament\Resources\SubContractResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSubContract extends EditRecord
{
    protected static string $resource = SubContractResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
