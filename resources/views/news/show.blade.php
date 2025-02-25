<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Notícia</title>

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
                <div class="min-h-[50rem] flex flex-col py-4">
                    <section class="bg-white flex flex-col my-6 p-8 rounded-2xl shadow-xl border border-gray-300 lg:w-amna-content-lg md:w-amna-app-content-md" style="font-size: 1.2em;">
                        <div class="w-full flex flex-col gap-4">
                            <header>
                                <h1 class="text-4xl font-bold text-[#010360] pb-2">{{ $news->title }}</h1>
                                <div>
                                    @if ($news->image_path)
                                        <img class="w-full h-52 rounded-lg border mb-4 object-cover" src="{{ asset($news->image_path) }}" alt="{{ $news->title }}">
                                    @endif
                                    <p class="text-lg text-gray-700 pb-4">{{ $news->description }}</p>
                                    <p class="text-gray-600 text-sm">📅 <strong>Data de criação:</strong> {{ \App\Helpers\DateHelper::formatDate($news->created_at) }}</p>
                                </div>
                            </header>
                            <main class="text-gray-800 leading-relaxed">
                                <section>
                                    <p>{!! nl2br(e($news->content)) !!}</p>
                                </section>
                            </main>
                            <footer class="mt-4 text-gray-600">
                                <p>✍️ <strong>Publicado por:</strong> {{ $news->author->name }} em {{ $news->created_at->format('d/m/Y à\s H:i') }}</p>
                                @if ($news->external_link)
                                    <p>🔗 <strong>Link externo:</strong> <a class="text-blue-600 hover:text-blue-400 font-semibold underline transition" href="{{ $news->external_link }}" target="_blank">{{ $news->external_link }}</a></p>
                                @endif
                            </footer>
                        </div>
                    </section>
                </div>
            </main>
        <x-footer/>
    </body>
</html> 
