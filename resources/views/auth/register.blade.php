<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastro</title>
</head>

<body>
    <h1>Cadastro</h1>
    @error('name')
        <span>{{ $message }}</span>
    @enderror

    @error('error')
        <span>{{ $message }}</span>
    @enderror

    @error('email')
        <span>{{ $message }}</span>
    @enderror

    @error('password')
        <span>{{ $message }}</span>
    @enderror

    @error('profile_photo')
        <span>{{ $message }}</span>
    @enderror

    <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="name">Nome</label>
        <input type="text" name="name" id="name">
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
        <label for="password">Senha</label>
        <input type="password" name="password" id="password">
        <label for="profile_photo">Imagem de perfil</label>
        <input type="file" name="profile_photo" id="profile_photo" accept="image/*" required>
        <button type="submit">Cadastrar</button>
    </form>
    <a href="{{ route('home') }}">Home</a>
</body>

</html>
