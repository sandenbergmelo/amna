<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Notícias</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="w-full h-full flex justify-center items-center flex-col bg-gray-100">
        <x-header/>
            <main class="h-full flex justify-center items-center flex-col px-5 lg:w-amna-app">
                <div class="min-h-[50rem] flex flex-col py-4 lg:w-amna-content-lg md:w-amna-app-content-md">
                    <h2 class="text-3xl lg:text-4xl font-bold text-[#010360] ">Últimas Notícias</h2>
                    @foreach ($news as $newsItem)
                        <section class="bg-white flex my-4 p-8 rounded-lg shadow-lg transition-all duration-200 hover:bg-gray-200 hover:scale-105 border-2 border-gray-300" style="font-size: 1.2em;">
                            <div>
                                @if ($newsItem->image_path)
                                    <img class="pe-4" src="{{ asset($newsItem->image_path) }}" alt="{{ $newsItem->title }}">
                                @endif
                            </div>
                            <div>
                                <main class="pb-2">
                                    <h3 class="text-lg font-bold">{{ $newsItem->title }}</h3>
                                    <p class="py-2">Postado por: <span class="font-bold">{{ $newsItem->author->name }}</span></p>
                                    <p class="pb-2">Data de criação: {{ \App\Helpers\DateHelper::formatDate($newsItem->created_at) }}</p>
                                    <p>{{ $newsItem->description }}</p>
                                </main>
                                <a class="text-blue-400 hover:text-blue-300 underline transition pt-2" href="{{ route('news.show', ['news' => $newsItem]) }}">Abrir notícia</a>
                            </div>
                        </section>
                    @endforeach
                </div>
            </main>
        <x-footer/>
    </body>
</html> 

