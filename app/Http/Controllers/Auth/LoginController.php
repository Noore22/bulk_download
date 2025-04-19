<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mews\Captcha\Facades\Captcha;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // Ensure you have `resources/views/auth/login.blade.php`
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            // 'captcha' => 'required|captcha'
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
