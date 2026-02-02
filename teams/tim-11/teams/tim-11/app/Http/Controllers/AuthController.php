<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        // Redirect to home if already logged in as admin
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect()->route('dashboard.admin');
        }
        return view('adminlogin');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Only admin can login
            if ($user->role !== 'admin') {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return back()->withErrors([
                    'email' => 'Akses ditolak. Halaman ini hanya untuk administrator.',
                ])->onlyInput('email');
            }

            if ($user->status === 'banned') {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return back()->withErrors([
                    'email' => 'Akun Anda telah dibanned. Hubungi admin untuk informasi lebih lanjut.',
                ])->onlyInput('email');
            }

            return redirect()->route('dashboard.admin');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
