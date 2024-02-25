<?php

namespace Database\Seeders;

use App\Models\ContractServices;
use App\Models\Debit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DebitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    protected $data = [
        '2023-01-01 00:00:00',
        '2023-02-01 00:00:00',
        '2023-03-01 00:00:00',
        '2023-04-01 00:00:00',
        '2023-05-01 00:00:00',
        '2023-06-01 00:00:00',
        '2023-07-01 00:00:00',
        '2023-08-01 00:00:00',
        '2023-09-01 00:00:00',
        '2023-10-01 00:00:00',
        '2023-11-01 00:00:00',
        '2023-12-01 00:00:00',
    ];

    public function run(): void
    {
        foreach ($this->data as $period) {
            $debit = Debit::firstOrCreate(['period'    => $period], ['status'    => 'open']);

            foreach (ContractServices::select('id', 'count', 'amount')->lazy() as $contractService) {
                $debit->contract_services()->attach([$contractService->id => ['count' => $contractService->count, 'amount' => $contractService->amount, 'sum' => (int)$contractService->count * (int)$contractService->amount]]);
            }
        }
    }
}
