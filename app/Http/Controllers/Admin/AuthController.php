<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Login form
    public function showLogin()
    {
        return view('admin.auth.login');
    }

    // Login process
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('web')->attempt($credentials)) {

            $request->session()->regenerate();

            return redirect()->route('products.index');
        }

        return back()->withErrors([
            'email' => 'Email və ya şifrə yanlışdır',
        ])->withInput();
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->forget('login_web');

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
