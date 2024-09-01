<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\Sales;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function form_login()
    {
        return view('login.index');
    }

    public function form_login_sales()
    {
        return view('login.sales-login');
    }

    public function authenticate(Request $request)
    {
         // Validasi manual untuk mengatasi berbagai kondisi
        $messages = [];
        if (!$request->filled('username') && !$request->filled('password')) {
            $messages['login_error'] = 'Username dan Password tidak terisi.';
        } elseif (!$request->filled('username')) {
            $messages['login_error'] = 'Username tidak boleh kosong.';
        } elseif (!$request->filled('password')) {
            $messages['login_error'] = 'Password tidak boleh kosong.';
        }

        if (!empty($messages)) {
            return redirect()->back()->withErrors($messages);
        }       

        // Jika validasi berhasil, lanjutkan dengan autentikasi
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'username' => 'Login gagal, silahkan coba kembali.',
        ]);
    }

        public function authenticate_user(Request $request)
    {
        // Validasi manual untuk mengatasi berbagai kondisi
        $messages = [];
        if (!$request->filled('username') && !$request->filled('password')) {
            $messages['login_error'] = 'Username dan Password tidak terisi.';
        } elseif (!$request->filled('username')) {
            $messages['login_error'] = 'Username tidak boleh kosong.';
        } elseif (!$request->filled('password')) {
            $messages['login_error'] = 'Password tidak boleh kosong.';
        }

        if (!empty($messages)) {
            return redirect()->back()->withErrors($messages);
        }

        // Jika validasi berhasil, lanjutkan dengan autentikasi
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/app-toko-sales');
        }

        return back()->withErrors([
            'username' => 'Login gagal, silahkan coba kembali.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function logout_user(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login-sales');
    }
}

