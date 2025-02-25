<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Deletar Perfil</title>
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="w-full h-full flex justify-center items-center flex-col">
    <main class="text-black flex justify-start items-center flex-col lg:justify-center lg:w-amna-app md:w-w-amna-app-content-md lg:h-screen">
        <div class="w-full py-4 mt-4 rounded-md transition-all duration-200 lg:mt-0 md:w-[25rem] md:shadow-2xl">
            <div class="h-full w-full flex flex-col pb-4">
                <div class="w-full flex flex-col">
                    <a class="w-full flex justify-start items-center text-7xl text-black font-serif bg-white px-7" href="{{ route('home') }}">
                        <img class="h-20" src="{{ asset('logos/logo.png') }}" alt="Logo da associação">
                        AMNA
                    </a>
                </div>
                <div class="w-full h-8 flex justify-start items-start px-7 my-6 text-lg">
                    <p>Deletar conta</p>
                </div>
                <div class="w-full px-7">
                    <form class="flex justify-start items-start flex-col" action="{{ route('users.destroy', $user) }}" method="post" method="post">
                        @csrf
                        @method('delete')
                        <div> 
                            <p>Tem certeza que deseja deletar a conta <span class="font-bold">{{ $user->name }}?</span></p>
                            <p>Essa ação não poderá ser desfeita.</p>
                        </div>
                        <div class="w-full flex justify-start flex-col">
                            <input class="bg-red-700 hover:bg-red-600 text-white text-center font-semibold py-1 px-3 my-4 border rounded transition duration-300 cursor-pointer" type="submit" value="Deletar">
                            <a class="bg-amna-terciary-600 hover:bg-amna-terciary-500 text-white text-center font-semibold py-1 px-3 border rounded transition duration-300 cursor-pointer" href="{{ route('dashboard') }}">Cancelar</a>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </main>
</body>
</html>

