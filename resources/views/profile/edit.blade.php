<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit</title>
    <style>
        form {
            display: flex;
            flex-direction: column;
            width: 50%;
            margin: 0 auto;
        }

        input {
            margin-bottom: 10px;
        }

        button {
            width: 100px;
            margin-top: 10px;
        }

        a {
            margin-top: 10px;
            display: block;
            text-align: center;
        }

        span {
            color: red;
        }
    </style>
</head>

<body>
    <h1>Editar</h1>
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

    @error('current_password')
        <span>{{ $message }}</span>
    @enderror

    @error('profile_photo')
        <span>{{ $message }}</span>
    @enderror

    <h2>Editar dados</h2>
    <form action="{{ route('users.update', $user) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <label for="name">Novo Nome</label>
        <input type="text" name="name" id="name" value="{{ $user->name }}" required>
        <label for="email">Novo Email</label>
        <input type="email" name="email" id="email" value="{{ $user->email }}" required>
        <label for="current_password">Senha atual</label>
        <input type="password" name="current_password" id="current_password" required>
        <label for="password">Nova senha (opcional)</label>
        <input type="password" name="password" id="password">
        <label for="password_confirmation">Confirme a nova senha</label>
        <input type="password" name="password_confirmation" id="password_confirmation">
        <button type="submit">Confirmar alterações</button>
    </form>
    <a href="{{ route('home') }}">Home</a>
</body>

</html>
