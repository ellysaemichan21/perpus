<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\LoanDetail;
use App\Models\Member;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    // ================= PINJAM =================
    public function pinjam(Book $book)
    {
        // Auth middleware handles login check

        // ================= CEK / BUAT MEMBER =================
        $member = Auth::user()->member;

        if (!$member) {
            $member = Member::create([
                'user_id' => Auth::id(),
                'nama'    => Auth::user()->name,
                'nim_nip' => 'MBR-' . str_pad(Auth::id(), 5, '0', STR_PAD_LEFT),
            ]);
        }

        // ================= CEK STOK =================
        if ($book->stok <= 0) {

            return back()->with(
                'error',
                'Stok buku habis'
            );
        }

        // ================= SIMPAN LOAN =================
        $loan = Loan::create([

            'member_id' => $member->id,

            'user_id' => Auth::id(),

            'tanggal_pinjam' => now(),

            'tanggal_kembali' => now()->addDays(7),

            'status' => 'dipinjam',
        ]);

        // ================= DETAIL LOAN =================
        LoanDetail::create([

            'loan_id' => $loan->id,

            'book_id' => $book->id,

            'jumlah' => 1,
        ]);

        // ================= KURANGI STOK =================
        $book->decrement('stok', 1);

        return back()->with(
            'success',
            'Buku "' . $book->judul . '" berhasil dipinjam!'
        );
    }

    // ================= BATAL PINJAM =================
    public function batal(Loan $loan)
    {
        // ================= KEMBALIKAN STOK =================
        foreach ($loan->loanDetails as $detail) {

            $detail->book->increment(
                'stok',
                $detail->jumlah
            );
        }

        // ================= HAPUS DETAIL =================
        $loan->loanDetails()->delete();

        // ================= HAPUS LOAN =================
        $loan->delete();

        return back()->with(
            'success',
            'Peminjaman berhasil dibatalkan'
        );
    }
}