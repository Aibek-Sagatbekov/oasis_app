<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Models\Contracts\HasName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser, HasAvatar, HasName
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function canAccessFilament(): bool
    {
        return true;
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url;
    }

    public function getFilamentName(): string
    {
        return $this->name;
    }

    public function address_resident(): HasOne
    {
        return $this->hasOne(UserAddressResident::class);
    }

    public function address_place(): HasOne
    {
        return $this->hasOne(UserAddressPlace::class);
    }

    public function passport(): HasOne
    {
        return $this->hasOne(UserPassport::class);
    }

    public function isAdmin(): bool
    {
        return $this->roles->pluck('name')->contains('super_admin') || $this->roles->pluck('name')->contains('admin');
    }
    public function notAdmin(): bool
    {
        return !($this->roles->pluck('name')->contains('super_admin') || $this->roles->pluck('name')->contains('admin'));
    }
}
