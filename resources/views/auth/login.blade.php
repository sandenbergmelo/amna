<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login</title>
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="w-full h-full flex justify-center items-center flex-col">
    <main
        class="text-black flex justify-start items-center flex-col lg:justify-center lg:w-amna-app md:w-w-amna-app-content-md lg:h-screen">
        <div class="w-full py-4 mt-4 rounded-md transition-all duration-200 lg:mt-0 md:w-[25rem] md:shadow-2xl">
            <div class="h-full w-full flex flex-col">
                <div class="w-full flex flex-col">
                    <a class="w-full flex justify-start items-center text-7xl text-black font-serif bg-white px-7"
                        href="{{ route('home') }}">
                        <img class="h-20" src="{{ asset('logos/logo.png') }}" alt="Logo da associação">
                        AMNA
                    </a>
                </div>
                <div class="w-full h-8 flex justify-start items-start px-7 my-6 text-lg">
                    <p>Acesse sua conta</p>
                </div>
                <div class="w-full px-7">
                    <form class="flex justify-start items-start flex-col" action="{{ route('login.store') }}"
                        method="POST">
                        @csrf
                        <div class="w-full py-2">
                            <label for="email">E-mail:</label>
                            <input class="w-full bg-white py-2 px-4 border border-black rounded" name="email"
                                placeholder="Seu e-mail" type="email" required>
                        </div>
                        <div class="w-full py-2 flex justify-start flex-col">
                            <label for="password">Senha:</label>
                            <input class="w-full bg-white py-2 px-4 border border-black rounded" name="password"
                                placeholder="Sua senha" type="password" minlength="8" required>
                        </div>
                        <div class="flex items-center space-x-2">
                            <label for="remember" class="text-gray-700 text-sm font-medium">Lembrar-se de mim</label>
                            <input type="checkbox" name="remember" id="remember"
                                class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2 cursor-pointer">
                        </div>
                        <div class="w-full flex justify-start flex-col">
                            <input
                                class="bg-amna-terciary-600 hover:bg-amna-terciary-500 text-white text-center font-semibold py-1 px-3 my-4 border rounded transition duration-300 cursor-pointer"
                                type="submit" value="Entrar">
                        </div>
                        <div class="text-red-600">
                            @error('name')
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

                            @error('error')
                                <span>{{ $message }}</span>
                            @enderror

                            @session('success')
                                <span class="text-green-600">{{ session('success') }}</span>
                            @endsession
                        </div>
                        <span class="border border-gray-500 w-full mt-8"></span>
                        <div class="bg-white w-full my-4 p-2">
                            <p>Ainda não tem uma conta?</p>
                            <a class="text-blue-400 hover:text-blue-300 underline transition"
                                href="{{ route('register') }}">Se inscreva gratuitamente</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
