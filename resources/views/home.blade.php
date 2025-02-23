<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Home</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    {{-- @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif --}}
</head>

<body>
    <main>
        <h1>Hello, World!</h1>

        @session('success')
            <span>{{ session('success') }}</span>
        @endsession

        <br>

        @if (auth()->check())
            <a href="{{ route('profile.index') }}">Profile</a>
            <a href="{{ route('logout') }}">Logout</a>
        @else
            <a href="{{ route('register') }}">Register</a>
            <a href="{{ route('login') }}">Login</a>
        @endif
    </main>
</body>

</html>
