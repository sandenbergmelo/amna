<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Perfil</title>
</head>

<body>
    <a href="{{ route('home') }}">Home</a>
    <h2>Perfil</h2>

    <img src="{{ asset($user->profile_photo_path) }}" width="200" height="200" alt="Foto de perfil">
    <br>

    @error('profile_photo')
        <span>{{ $message }}</span>
    @enderror

    @error('error')
        <span>{{ $message }}</span>
    @enderror

    @session('success')
        <span>{{ session('success') }}</span>
    @endsession

    <form action="{{ route('profile.update-photo', $user) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <label for="profile_photo">Trocar foto de perfil: </label>
        <input type="file" name="profile_photo" id="profile_photo">
        <br>
        <br>
        <button type="submit">Enviar</button>
    </form>
    <span>Logado como "{{ $user->name }}"</span>
    <a href="{{ route('profile.edit') }}">Editar</a>
    <a href="{{ route('logout') }}">Logout</a>
</body>

</html>
