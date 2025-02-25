<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Notícia</title>
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
                    <p>Editar notícia</p>
                </div>
                <div class="w-full px-7">
                    <form class="flex justify-start items-start flex-col" action="{{ route('news.update', $news->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="w-full py-2 flex flex-col">
                            <label for="image">Imagem relacionada (deixe em branco para manter a atual)</label>
                            <input class="text-black text-center font-semibold py-2 transition duration-300 cursor-pointer" type="file" name="image" id="image" accept="image/*">
                        </div>
                        <div class="w-full py-2">
                            <label for="title">Título</label>
                            <input class="w-full bg-white py-2 px-4 border border-black rounded" type="text" name="title" id="title" value="{{ $news->title }}" placeholder="Título da notícia" required>
                        </div>
                        <div class="w-full py-2">
                            <label for="description">Mini descrição</label>
                            <textarea class="w-full bg-white py-2 px-4 border border-black rounded" name="description" id="description" rows="3" placeholder="Mini descrição da notícia" required>{{ $news->description }}</textarea>
                        </div>
                        <div class="w-full py-2">
                            <label for="content">Conteúdo</label>
                            <textarea class="w-full bg-white py-2 px-4 border border-black rounded" name="content" id="content" cols="30" rows="10" placeholder="Conteúdo da notícia" required>{{ $news->content }}</textarea>
                        </div>
                        <div class="w-full py-2">
                            <label for="external_link">Link externo</label>
                            <input class="w-full bg-white py-2 px-4 border border-black rounded" type="url" name="external_link" id="external_link" value="{{ $news->external_link }}" placeholder="Link externo (opcional)">
                        </div>
                        <div class="w-full flex justify-start flex-col">
                            <input class="bg-amna-terciary-600 hover:bg-amna-terciary-500 text-white text-center font-semibold py-1 px-3 my-4 border rounded transition duration-300 cursor-pointer" type="submit" value="Editar">
                        </div>
                        <div class="text-red-600">
                            @error('title')
                                <p>{{ $message }}</p>
                            @enderror

                            @error('content')
                                <p>{{ $message }}</p>
                            @enderror

                            @error('external_link')
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


