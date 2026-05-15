<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Loan;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $books = Book::with('category')->get();

        $categories = Category::all();

        // ================= USER ACTIVE LOANS =================
        $userLoans = collect();

        if (Auth::check() && Auth::user()->member) {

            $userLoans = Loan::where('member_id', Auth::user()->member->id)
                ->where('status', 'dipinjam')
                ->with('loanDetails.book')
                ->latest()
                ->take(5)
                ->get();
        }

        return view('welcome', compact(
            'books',
            'categories',
            'userLoans'
        ));
    }
}