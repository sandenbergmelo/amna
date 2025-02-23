<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('profile.index');
        }

        return view('auth.login');
    }

    public function store(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = boolval($request->remember);

        $authenticated = Auth::attempt($credentials, $remember);

        if (!$authenticated) {
            return redirect()->route('login')->withErrors([
                'error' => 'Email ou senha inválidos',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->route('profile.index')->with('success', 'Login efetuado com sucesso');
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Logout efetuado com sucesso');
    }
}
