<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Member;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ================= LOGIN PAGE =================
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect('/library');
        }

        return view('auth.login');
    }

    // ================= LOGIN =================
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {

            $request->session()->regenerate();

            return redirect()->intended('/library');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // ================= REGISTER PAGE =================
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect('/library');
        }

        return view('auth.register');
    }

    // ================= REGISTER =================
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'member',
        ]);

        // ================= AUTO-CREATE MEMBER =================
        Member::create([
            'user_id' => $user->id,
            'nama'    => $user->name,
            'nim_nip' => 'MBR-' . str_pad($user->id, 5, '0', STR_PAD_LEFT),
        ]);

        Auth::login($user);

        return redirect('/library')->with(
            'success',
            'Registrasi berhasil! Selamat datang, ' . $user->name
        );
    }

    // ================= LOGOUT =================
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/library');
    }
}
