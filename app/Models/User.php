<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Loan;
use App\Models\Member;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

use Database\Factories\UserFactory;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

#[Fillable([
    'name',
    'email',
    'password',
    'role'
])]

#[Hidden([
    'password',
    'remember_token'
])]

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    // ================= FILAMENT GATE =================
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->role === 'admin';
    }

    // ================= HELPER =================
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    // ================= MEMBER =================
    public function member(): HasOne
    {
        return $this->hasOne(Member::class);
    }

    // ================= LOAN =================
    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
    }

    /**
     * ================= CAST =================
     */
    protected function casts(): array
    {
        return [

            'email_verified_at' => 'datetime',

            'password' => 'hashed',

        ];
    }
}