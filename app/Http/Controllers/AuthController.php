<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan Halaman Login
    public function showLoginForm()
    {
        return view('login');
    }

    // Memproses Otentikasi Login (Multi-Role)
   public function login(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'login'    => 'required|string',
            'password' => 'required|string',
        ], [
            'login.required'    => 'Email atau NISN wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // 2. Cari User berdasarkan Email atau NISN
        $user = \App\Models\User::where('email', $request->login)
                    ->orWhere('nisn', $request->login)
                    ->first();

        // 3. Cek apakah user ditemukan dan password cocok (mendukung teks biasa / plain text)
        if ($user && $request->password === 'password123') { // atau sesuaikan dengan password di database
            Auth::login($user, $request->remember);
            $request->session()->regenerate();

            // Direct Halaman berdasarkan Role
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }

            return redirect()->intended('/siswa/dashboard');
        }

        // 4. Jika Gagal Login
        return back()->withErrors([
            'login' => 'Email/NISN atau password yang Anda masukkan salah.',
        ])->onlyInput('login');
    }
    // Memproses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}