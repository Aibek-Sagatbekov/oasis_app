<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contract extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'type',
        'client_id',
        'number',
        'date',
        'date_start',
        'date_end',
        'comment',
        'manager_id',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function sub_contracts()
    {
        return $this->hasMany(SubContract::class);
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
}
