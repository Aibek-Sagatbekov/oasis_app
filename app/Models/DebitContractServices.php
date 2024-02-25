<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class DebitContractServices extends Pivot
{
    use HasFactory;

    protected $table = 'contract_services_debit';
}
