<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPassport extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'granted',
        'granted_at',
    ];
}
