<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ContractServices extends Model
{

    protected $fillable = [
        'contract_id',
        'sub_contract_id',
        'service_type_id',
        'program_id',
        'indicator_id',
        'state_id',
        'count',
        'amount',
    ];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function sub_contract()
    {
        return $this->belongsTo(SubContract::class);
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function service_type()
    {
        return $this->belongsTo(ServiceType::class);
    }
    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function indicator()
    {
        return $this->belongsTo(Indicator::class);
    }

    public function debits()
    {
        return $this->belongsToMany(Debit::class)->withPivot('count', 'sum')->withTimestamps();
    }

    public function counts()
    {
        return $this->sum('count');
    }
}
