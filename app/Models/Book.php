<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'kode_buku',
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'stok',
        'cover',
        'owner_id',
    ];

    // ================= CATEGORY =================
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // ================= OWNER =================
    public function owner(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'owner_id');
    }

    // ================= DETAIL =================
    public function loanDetails(): HasMany
    {
        return $this->hasMany(LoanDetail::class);
    }
}