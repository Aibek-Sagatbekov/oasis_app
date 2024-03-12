<?php

namespace App\Filament\Resources\ContractServicesResource\Pages;

use App\Filament\Resources\ContractServicesResource;
use App\Filament\Pages\Actions\Test;
use App\Models\ContractServices;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request; 

class ListContractServices extends ListRecords
{
    protected static string $resource = ContractServicesResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeading(): string
    {
        // Получаем отфильтрованный запрос
        $filteredQuery = $this->getFilteredTableQuery();

        // Вычисляем общую сумму
        $totalAmount = $filteredQuery->sum('amount');
        $totalCount = $filteredQuery->sum('count');

        // Форматируем сумму 
        $formattedTotalAmount = number_format($totalAmount, 2, ',', ' ');
        $formattedTotalCount = number_format($totalCount, 0, ',', ' ');

        // Возвращаем заголовок с общей суммой
        return parent::getHeading() . " | Общая сумма: $formattedTotalAmount" . " 〒 | Общая кол-во: $formattedTotalCount";
    }
}