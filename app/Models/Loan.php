<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'user_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
        'escrow_amount',
        'p2p_status',
    ];

    protected $casts = [
        'tanggal_pinjam'  => 'date',
        'tanggal_kembali' => 'date',
    ];

    // ================= MEMBER =================
    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    // ================= USER =================
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // ================= DETAIL =================
    public function loanDetails(): HasMany
    {
        return $this->hasMany(LoanDetail::class);
    }

    // ================= RETURN =================
    public function returnBook(): HasOne
    {
        return $this->hasOne(ReturnBook::class);
    }
}