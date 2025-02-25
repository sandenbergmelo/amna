<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sobre</title>

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
                    <h2 class="text-3xl lg:text-4xl font-bold text-[#010360] ">Sobre Nós</h2>
                    <section class="bg-white flex my-4 p-8 rounded-lg shadow-lg transition-all duration-200 hover:bg-gray-200 hover:scale-105 border-2 border-gray-300" style="font-size: 1.2em;">
                        <p></p>
                    </section>
                </div>
            </main>
        <x-footer/>
    </body>
</html>