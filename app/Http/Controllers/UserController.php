<?php

namespace App\Http\Controllers;

use App\Helpers\EmailHelper;
use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::check()) {
            /**  @var User */
            $user = Auth::user();

            if(!($user->profile_type === 'admin')) {
                return redirect()->route('profile.index');
            }
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

        if (!EmailHelper::emailExists($request->email)) {
            return redirect()->route('register')->withErrors([
                'email' => 'Email não existe',
            ]);
        }

        User::create($request->all());

        return redirect()->route('login')->with('success', 'Registro efetuado com sucesso');
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
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $authenticatedUser = Auth::user();

        // Check if the authenticated user is the same as the user being updated
        if ($authenticatedUser->id !== $user->id) {
            return redirect()->route('profile.index')->withErrors([
                'error' => 'Você não tem permissão para editar este usuário',
            ]);
        }

        // Check the password match
        if (!password_verify($request->current_password, $authenticatedUser->password)) {
            return redirect()->route('profile.edit')->withErrors([
                'current_password' => 'Senha atual inválida',
            ]);
        }

        // Check if password is equal to password confirmation
        if ($request->filled('password') && $request->password !== $request->password_confirmation) {
            return redirect()->route('profile.edit')->withErrors([
                'password' => 'Senha não confere com a confirmação',
            ]);
        }

        if (!$request->filled('password')) {
            $request->merge(['password' => $request->current_password]);
        }

        $user->update($request->all());

        return redirect()->route('profile.index')->with('success', 'Perfil atualizado com sucesso');
    }

    /**
     * Update the user profile photo.
     */
    public function updatePhoto(Request $request, User $user)
    {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'profile_photo.required' => 'Selecione uma imagem',
            'profile_photo.image' => 'O arquivo selecionado não é uma imagem',
            'profile_photo.mimes' => 'A imagem deve ser do tipo jpeg, png ou jpg',
            'profile_photo.max' => 'A imagem não pode ter mais de 2MB',
        ]);

        $authenticatedUser = Auth::user();

        // Check if the authenticated user is the same as the user being updated
        if ($authenticatedUser->id !== $user->id) {
            return redirect()->route('profile.index')->withErrors([
                'error' => 'Você não tem permissão para editar este usuário',
            ]);
        }

        $profile_photo = $request->file('profile_photo');
        $photo_file_name = date('YmdHisu')
            . '-'
            . str_replace(' ', '-', $user->name)
            . '.'
            . $profile_photo->extension();

        $profile_photo->storeAs('profile_photos', $photo_file_name, 'public');

        $user->update([
            'profile_photo_path' => 'storage/profile_photos/' . $photo_file_name,
        ]);

        // Remove the old profile photo
        $old_profile_photo = $authenticatedUser->profile_photo_path;
        if ($old_profile_photo && $old_profile_photo !== 'storage/profile_photos/default.png') {
            $old_profile_photo_path = public_path($old_profile_photo);
            if (file_exists($old_profile_photo_path)) {
                unlink($old_profile_photo_path);
            }
        }

        return redirect()->route('profile.index')->with('success', 'Foto de perfil atualizada com sucesso');
    }

    public function delete(User $user)
    {
        $authenticatedUser = Auth::user();

        // Check if the authenticated user is the same as the user being updated
        if ($authenticatedUser->id !== $user->id) {
            return redirect()->route('profile.index')->withErrors([
                'error' => 'Você não tem permissão para excluir este usuário',
            ]);
        }

        return view('profile.delete', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $authenticatedUser = Auth::user();

        // Check if the authenticated user is the same as the user being updated
        if ($authenticatedUser->id !== $user->id) {
            return redirect()->route('profile.index')->withErrors([
                'error' => 'Você não tem permissão para excluir este usuário',
            ]);
        }

        $user->delete();

        // Remove the user profile photo
        $profile_photo = $authenticatedUser->profile_photo_path;
        if ($profile_photo && $profile_photo !== 'storage/profile_photos/default.png') {
            $profile_photo_path = public_path($profile_photo);
            if (file_exists($profile_photo_path)) {
                unlink($profile_photo_path);
            }
        }

        return redirect()->route('home')->with('success', 'Conta excluída com sucesso');
    }
}
