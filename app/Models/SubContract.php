<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubContract extends Model
{
    use HasFactory;

    protected $fillable = [
        'contract_id',
        'number',
        'date_start',
        'date_end',
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
    public function sub_contract()
    {
        return $this->belongsTo(SubContract::class);
    }
}
