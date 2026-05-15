<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Member;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // ================= CEK / BUAT MEMBER =================
        $member = Auth::user()->member;

        if (!$member) {
            $member = Member::create([
                'user_id' => Auth::id(),
                'nama'    => Auth::user()->name,
                'nim_nip' => 'MBR-' . str_pad(Auth::id(), 5, '0', STR_PAD_LEFT),
            ]);
        }

        // ================= ACTIVE LOANS =================
        $activeLoans = Loan::where('member_id', $member->id)
            ->where('status', 'dipinjam')
            ->with('loanDetails.book')
            ->latest()
            ->get();

        // ================= HISTORY =================
        $historyLoans = Loan::where('member_id', $member->id)
            ->where('status', 'dikembalikan')
            ->with(['loanDetails.book', 'returnBook'])
            ->latest()
            ->get();

        // ================= STATS =================
        $stats = [
            'active'   => $activeLoans->count(),
            'dueSoon'  => $activeLoans->filter(
                fn ($l) => !$l->tanggal_kembali->startOfDay()->isPast()
                    && now()->startOfDay()->diffInDays($l->tanggal_kembali->startOfDay()) <= 2
            )->count(),
            'overdue'  => $activeLoans->filter(
                fn ($l) => $l->tanggal_kembali->startOfDay()->isPast()
            )->count(),
            'returned' => $historyLoans->count(),
        ];

        return view('member.dashboard', compact(
            'activeLoans',
            'historyLoans',
            'stats'
        ));
    }
}
