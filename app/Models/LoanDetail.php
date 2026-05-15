<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoanDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_id',
        'book_id',
        'jumlah',
    ];

    // ================= LOAN =================
    public function loan(): BelongsTo
    {
        return $this->belongsTo(Loan::class);
    }

    // ================= BOOK =================
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}