<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ], [
            'name.required' => 'O nome é obrigatório.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'O e-mail informado não é válido.',
            'email.unique' => 'O e-mail informado já está em uso.',
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres.',
            'profile_photo.required' => 'A foto de perfil é obrigatória.',
        ]);

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

        return redirect()->route('login');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return view('profile.profile');
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
