<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Criar Evento</title>
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="w-full h-full flex justify-center items-center flex-col">
    <main class="text-black flex justify-start items-center flex-col lg:justify-center lg:w-amna-app md:w-w-amna-app-content-mdlg:h-screen">
        <div class="w-full py-4 mt-4 rounded-md transition-all duration-200 lg:mt-0 md:w-[25rem] md:shadow-2xl">
            <div class="h-full w-full flex flex-col">
                <div class="w-full flex flex-col">
                    <a class="w-full flex justify-start items-center text-7xl text-black font-serif bg-white px-7" href="{{ route('home') }}">
                        <img class="h-20" src="{{ asset('logos/logo.png') }}" alt="Logo da associação">
                        AMNA
                    </a>
                </div>
                <div class="w-full h-8 flex justify-start items-start px-7 my-6 text-lg">
                    <p>Criar evento</p>
                </div>
                <div class="w-full px-7">
                    <form class="flex justify-start items-start flex-col" action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="w-full py-2 flex flex-col">
                            <label for="image">Imagem relacionada (opcional)</label>
                            <input class="text-black text-center font-semibold py-2 transition duration-300 cursor-pointer" type="file" name="image" id="image" accept="image/*">
                        </div>
                        <div class="w-full py-2">
                            <label for="title">Título</label>
                            <input class="w-full bg-white py-2 px-4 border border-black rounded" type="text" name="title" id="title" placeholder="Título do evento" required>
                        </div>
                        <div class="w-full py-2">
                            <label for="description">Mini Descrição</label>
                            <textarea class="w-full bg-white py-2 px-4 border border-black rounded" name="description" id="description" rows="3" required></textarea>
                        </div>
                        <div class="w-full py-2">
                            <label for="content">Conteúdo</label>
                            <textarea class="w-full bg-white py-2 px-4 border border-black rounded" name="content" id="content" rows="10" required></textarea>
                        </div>
                        <div class="w-full py-2">
                            <label for="start_date">Data de início</label>
                            <input class="w-full bg-white py-2 px-4 border border-black rounded" type="date" name="start_date" id="start_date" required>
                        </div>
                        <div class="w-full py-2">
                            <label for="end_date">Data de término</label>
                            <input class="w-full bg-white py-2 px-4 border border-black rounded" type="date" name="end_date" id="end_date" required>
                        </div>
                        <div class="w-full py-2">
                            <label for="start_time">Hora de início</label>
                            <input class="w-full bg-white py-2 px-4 border border-black rounded" type="time" name="start_time" id="start_time" required>
                        </div>
                        <div class="w-full py-2">
                            <label for="end_time">Hora de término</label>
                            <input class="w-full bg-white py-2 px-4 border border-black rounded" type="time" name="end_time" id="end_time" required>
                        </div>
                        <div class="w-full py-2">
                            <label for="location">Localização</label>
                            <input class="w-full bg-white py-2 px-4 border border-black rounded" type="text" name="location" id="location" required>
                        </div>
                        <div class="w-full flex justify-start flex-col">
                            <input class="bg-amna-terciary-600 hover:bg-amna-terciary-500 text-white text-center font-semibold py-1 px-3 my-4 border rounded transition duration-300 cursor-pointer" type="submit" value="Criar">
                        </div>
                        <div class="text-red-600">
                            @error('title')
                                <p>{{ $message }}</p>
                            @enderror

                            @error('description')
                                <p>{{ $message }}</p>
                            @enderror

                            @error('content')
                                <p>{{ $message }}</p>
                            @enderror

                            @error('start_date')
                                <p>{{ $message }}</p>
                            @enderror

                            @error('end_date')
                                <p>{{ $message }}</p>
                            @enderror

                            @error('start_time')
                                <p>{{ $message }}</p>
                            @enderror

                            @error('end_time')
                                <p>{{ $message }}</p>
                            @enderror

                            @error('location')
                                <p>{{ $message }}</p>
                            @enderror

                            @error('image')
                                <p>{{ $message }}</p>
                            @enderror

                            @error('error')
                                <p>{{ $message }}</p>
                            @enderror
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </main>
</body>
</html>

