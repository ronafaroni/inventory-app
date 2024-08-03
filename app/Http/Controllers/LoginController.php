<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\Sales;

class LoginController extends Controller
{
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
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        $user = \App\Models\User::where('username', $credentials['username'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            if (Hash::needsRehash($user->password)) {
                $user->password = Hash::make($credentials['password']);
                $user->save();
            }

            Auth::login($user);
            $request->session()->regenerate();

            if ($user->role == 'admin') {
                return redirect()->intended('/dashboard');
            } else {
                return redirect()->intended('/users');
            }
        }

        return back()->withErrors([
            'username' => 'Login gagal, silahkan coba kembali.',
        ]);
    }

    public function authenticate_user(Request $request)
    {
        // Logging for debugging
        Log::info('Starting authentication process');

        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        Log::info('Credentials validated', $credentials);

        $sales = Sales::where('username', $credentials['username'])->first();

        if ($sales) {
            Log::info('User found', ['username' => $credentials['username']]);

            if (Hash::check($credentials['password'], $sales->password)) {
                Log::info('Password check successful');

                if (Hash::needsRehash($sales->password)) {
                    Log::info('Rehashing password');
                    $sales->password = Hash::make($credentials['password']);
                    $sales->save();
                }

                Auth::guard('sales')->login($sales);
                $request->session()->regenerate();
                Log::info('User logged in successfully');

                return redirect()->intended('/users');
            } else {
                Log::warning('Password check failed', ['username' => $credentials['username']]);
            }
        } else {
            Log::warning('User not found', ['username' => $credentials['username']]);
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
        return redirect('/login');
    }

    public function logout_user(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login-sales');
    }
}

