<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginView()
    {
        if (Auth::check()) {
            return back();
        }

        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        if (Auth::check()) {
            return back();
        }

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();  // Logout pengguna

        $request->session()->invalidate();  // Menghapus session

        $request->session()->regenerateToken();  // Menghasilkan ulang token CSRF

        return redirect('/login');  // Redirect ke halaman login setelah logout
    }
}
