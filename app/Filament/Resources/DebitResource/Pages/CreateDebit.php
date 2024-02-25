<?php

namespace App\Filament\Resources\DebitResource\Pages;

use App\Filament\Resources\DebitResource;
use App\Models\ContractServices;
use App\Models\Debit;
use Carbon\Carbon;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDebit extends CreateRecord
{
    protected static string $resource = DebitResource::class;

    public function mount(): void
    {
        $this->authorizeAccess();

        $record = Debit::query()->latest()->first();
        $newPeriod = today()->firstOfYear();

        if ($record) {
            $lastPeriod = Carbon::createFromDate($record->period);
            $newPeriod = $lastPeriod->addMonth();
        }

        $this->record = $this->handleRecordCreation([
            'period'    => $newPeriod
        ]);

        foreach (ContractServices::select('id', 'count', 'amount')->lazy() as $contractService) {
            $this->record->contract_services()->attach([$contractService->id => ['count' => $contractService->count, 'amount' => $contractService->amount, 'sum' => (int)$contractService->count * (int)$contractService->amount]]);
        }

        redirect()->route('filament.resources.debits.edit', $this->record->id);
    }
}
