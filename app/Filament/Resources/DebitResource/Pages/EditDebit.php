<?php

namespace App\Filament\Resources\DebitResource\Pages;

use App\Filament\Resources\DebitResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDebit extends EditRecord
{
    protected static string $resource = DebitResource::class;

    protected function getActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
}
