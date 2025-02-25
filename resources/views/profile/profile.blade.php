<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pefil</title>
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="w-full h-full flex justify-center items-center flex-col bg-gray-100">
    <x-profile.header/>
    <main class="lg:w-amna-app w-full h-full text-black flex justify-center items-center flex-col px-5">
        <div class="min-h-[50rem] flex flex-col py-4 lg:w-amna-content-lg md:w-amna-app-content-md">
            <h2 class="text-3xl lg:text-4xl font-bold text-[#010360] ">Seu Perfil</h2>
            @session('success')
                <span class="text-green-400 py-4">{{ session('success') }}</span>
            @endsession
            @error('error')
                <span>{{ $message }}</span>
            @enderror
            <div class="bg-white flex flex-col my-4 p-8 rounded-lg shadow-lg border-2 border-gray-300">
                <main class="w-full text-black flex flex-col justify-center items-center">
                    <div class="flex justify-center items-center">
                        <p class="text-lg font-bold pe-2"></p>
                        <img class="w-14 h-14 border rounded-full border-black hover:bg-gray-400" src="{{ asset(auth()->user()->profile_photo_path) }}" alt="{{ auth()->user()->name }}">
                    </div>
                    <div class="w-full flex flex-col justify-center items-center pt-3">
                        <p class="text-lg font-bold">{{ $user->name }} </p>
                        <p class="text-lg font-bold">{{ $user->email }} </p>
                    </div>
                </main>
            </div>  
            <div class="bg-white flex flex-col my-4 p-8 rounded-lg shadow-lg border-2 border-gray-300">
                <div class="text-black w-full">
                    <header class="mb-4">
                        <h2 class="text-lg font-bold">Editar seu perfil</h2> 
                        <p class="pt-1">Para editar seu perfil basta clicar no botão abaixo.</p>
                    </header>
                    <a class="bg-amna-terciary-600 hover:bg-amna-terciary-500 text-white text-center font-semibold py-1 px-3 my-4 border rounded transition duration-300" href="{{ route('profile.edit') }}">Editar</a>
                </div>
            </div>  
            <div class="bg-white flex flex-col my-4 p-8 rounded-lg shadow-lg border-2 border-gray-300">
                <div class="text-black w-full">
                    <form class="flex justify-start items-start flex-col" action="{{ route('profile.update-photo', $user) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="w-full py-2 flex flex-col">
                            <label class="text-lg font-bold" for="profile_photo">Trocar foto de perfil</label>
                            <input class="text-black text-center font-semibold py-2 transition duration-300 cursor-pointer" type="file" name="profile_photo" id="profile_photo" accept="image/*" size="" required>
                        </div>
                        <div class="w-full flex justify-start">
                            <input class="bg-amna-terciary-600 hover:bg-amna-terciary-500 text-white text-center font-semibold py-1 px-3 my-4 border rounded transition duration-300 cursor-pointer" type="submit" value="Trocar">
                        </div>
                    </form> 
                </div>
            </div>
            <div class="bg-white flex flex-col my-4 p-8 rounded-lg shadow-lg border-2 border-gray-300">
                <div class="text-black w-full">
                    <header>
                        <h2 class="text-lg font-bold">Deletar Conta</h2> 
                        <p class="pt-1">Uma vez que sua conta é deletada, todos os seus recursos e dados serão permanentemente deletados. Antes de deletar sua conta, por favor, baixe qualquer dado ou informação que você deseja guardar.</p>
                    </header>
                    <div class="flex justify-start items-start flex-col">
                        <a class="bg-red-700 hover:bg-red-600 text-white text-center font-semibold py-1 px-3 my-4 border rounded transition duration-300" href="{{ route('profile.delete', $user) }}">Deletar</a>
                    </div> 
                </div>
            </div>  
        </div>
    </main>
</body>
</html>
