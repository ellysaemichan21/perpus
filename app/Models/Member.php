<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Member extends Model
{
    use HasFactory;

    protected $table = 'members';

    protected $fillable = [

        'user_id',

        'nama',

        'nim_nip',

        'jenis_kelamin',

        'alamat',

        'no_hp',
    ];

    // ================= USER =================
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // ================= LOANS =================
    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
    }
}