<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::check()) {
            return redirect()->route('profile.index');
        }

        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        $name = $request->name;

        $profile_photo = $request->file('profile_photo');
        $photo_file_name = date('YmdHisu')
            . '-'
            . str_replace(' ', '-', $name)
            . '.'
            . $profile_photo->extension();

        $profile_photo->storeAs('profile_photos', $photo_file_name, 'public');
        $profile_photo_path = 'storage/profile_photos/' . $photo_file_name;
        $request['profile_photo_path'] = $profile_photo_path;

        User::create($request->all());

        // Authenticate the user
        $credentials = $request->only('email', 'password');
        $authenticated = Auth::attempt($credentials);

        if (!$authenticated) {
            return redirect()->route('login')->withErrors([
                'error' => 'Email ou senha inválidos',
            ]);
        }

        return redirect()->route('profile.index')->with('success', 'Login efetuado com sucesso');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $user = Auth::user();
        return view('profile.profile', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
