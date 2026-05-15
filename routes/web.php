<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoanController;

Route::redirect('/', '/library');

// ================= HOME =================
Route::get('/library', [HomeController::class, 'index'])
    ->name('home');

// ================= AUTH (PUBLIC) =================
Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',   [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register',[AuthController::class, 'register']);
Route::post('/logout',  [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ================= MEMBER =================
Route::middleware(['auth'])->group(function () {

    // dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // pinjam buku
    Route::post(
        '/pinjam/{book}',
        [LoanController::class, 'pinjam']
    )->name('pinjam.buku');

    // batal pinjam
    Route::post(
        '/batal-pinjam/{loan}',
        [LoanController::class, 'batal']
    )->name('batal.pinjam');

});