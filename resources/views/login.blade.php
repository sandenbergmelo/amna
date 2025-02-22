<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>

<body>
    <a href="{{ route('home') }}">Home</a>
    <h2>Login</h2>

    @if (session('success'))
        <span>{{ session('success') }}</span>
    @endif

    @if (auth()->check())
        Já está logado como {{ auth()->user()->name }}
        <a href="{{ route('logout') }}">Logout</a>
    @else
        @error('error')
            <span>{{ $message }}</span>
        @enderror

        @error('email')
            <span>{{ $message }}</span>
        @enderror

        @error('password')
            <span>{{ $message }}</span>
        @enderror

        <form action="{{ route('login.store') }}" method="POST">
            @csrf
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            <button type="submit">Login</button>
        </form>
    @endif
</body>

</html>
