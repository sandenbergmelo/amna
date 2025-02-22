<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController
{
    public function index()
    {
        return view('login');
    }

    public function store(Request $request)
    {
        $PASSWORD_MIN_LENGTH = 8;

        $request->validate([
            'email' => 'required|email',
            'password' => "required|min:$PASSWORD_MIN_LENGTH",
        ], [
            'email.required' => 'Email é obrigatório',
            'email.email' => 'Email inválido',
            'password.required' => 'Senha é obrigatória',
            'password.min' => "Senha deve ter no mínimo $PASSWORD_MIN_LENGTH caracteres",
        ]);

        $credentials = $request->only('email', 'password');

        $authenticated = Auth::attempt($credentials);

        if (!$authenticated) {
            return redirect()->route('login.index')->withErrors([
                'error' => 'Email ou senha inválidos',
            ]);
        }

        return redirect()->route('perfil.index')->with('success', 'Login efetuado com sucesso');
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        return redirect()->route('login.index')->with('success', 'Logout efetuado com sucesso');
    }
}
