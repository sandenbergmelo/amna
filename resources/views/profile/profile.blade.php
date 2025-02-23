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

    {{-- @if (session('success'))
        <span>{{ session('success') }}</span>
    @endif --}}

    <img src="{{ asset($user->profile_photo_path) }}" width="200" height="200" alt="Foto de perfil">
    <br>
    <span>Logado como "{{ $user->name }}"</span>
    <a href="{{ route('profile.edit') }}">Editar</a>
    <a href="{{ route('logout') }}">Logout</a>
</body>

</html>
