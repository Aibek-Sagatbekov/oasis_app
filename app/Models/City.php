<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'state_id', 'area_id', 'district_id'
    ];

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }
}
