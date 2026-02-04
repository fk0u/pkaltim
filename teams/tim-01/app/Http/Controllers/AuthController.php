<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('Login');
    }

    public function login(Request $request)
    {
        // 1. Validasi Username & Password
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        // 2. Coba Login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // PERBAIKAN DI SINI:
            // Kita pakai redirect()->route() supaya mengarah ke 'admin.dashboard'
            // Walaupun URL-nya berubah-ubah, selama nama route-nya sama, ini akan jalan.
            return redirect()->route('admin.dashboard');
        }

        // 3. Jika Gagal
        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}