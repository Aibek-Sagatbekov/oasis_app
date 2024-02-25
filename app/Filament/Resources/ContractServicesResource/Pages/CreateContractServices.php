<?php

namespace App\Filament\Resources\ContractServicesResource\Pages;

use App\Filament\Resources\ContractServicesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Exceptions\Halt;

class CreateContractServices extends CreateRecord
{
    protected static string $resource = ContractServicesResource::class;

    public function create(bool $another = false): void
    {
        $this->authorizeAccess();

        try {
            $this->callHook('beforeValidate');

            $data = $this->form->getState();

            $this->callHook('afterValidate');

            $data = $this->mutateFormDataBeforeCreate($data);

            $this->callHook('beforeCreate');

            $this->record = $this->handleRecordCreation($data);

            $this->form->model($this->record)->saveRelationships();

            $this->callHook('afterCreate');
        } catch (Halt $exception) {
            return;
        }

        $this->getCreatedNotification()?->send();

        if ($another) {
            // Ensure that the form record is anonymized so that relationships aren't loaded.
            $this->form->model($this->record::class);
            $this->record = null;
            $this->form->fill(collect($this->data)->only(["contract_id", "sub_contract_id", "service_type_id", "state_id", "count", "amount"])->toArray());
            return;
        }

        $this->redirect($this->getRedirectUrl());
    }
}
