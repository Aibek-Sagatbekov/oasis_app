<?php

namespace App\Filament\Resources\ProgramTypeResource\Pages;

use App\Filament\Resources\ProgramTypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProgramTypes extends ListRecords
{
    protected static string $resource = ProgramTypeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
