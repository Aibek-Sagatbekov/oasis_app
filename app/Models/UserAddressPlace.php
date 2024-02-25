<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddressPlace extends Model
{
    use HasFactory;

    protected $fillable = [

        'address_name',
        'full_address',
        'country',
        'region',
        'district',
        'locality',
        'street',
        'house_number',
        'house_frontway',
        'house_floor',
        'apartment',

        'latitude',
        'longitude',
        'type',

    ];
}
