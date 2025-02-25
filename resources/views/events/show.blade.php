<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Evento</title>

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
                        <div>
                            @if ($event->image_path)
                                <img class="w-full h-52 rounded-lg border mb-4 object-cover" src="{{ asset($event->image_path) }}" alt="{{ $event->title }}">
                            @endif
                        </div>
                        <div class="w-full flex flex-col gap-4">
                            <header>
                                <h1 class="text-4xl font-bold text-[#010360] pb-2">{{ $event->title }}</h1>
                                <p class="text-gray-600">📅 <strong>De:</strong> {{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y') }} até
                                    {{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y') }}
                                </p>
                                <p class="text-gray-600">⏰ <strong>Horário:</strong> {{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} -
                                    {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }}
                                </p>
                                <h4 class="text-gray-700">📍 <strong>Local:</strong> {{ $event->location }}</h4>
                                <h3 class="text-lg text-gray-700 pb-4">{{ $event->description }}</h3>
                            </header>
                            <main class="text-gray-800 leading-relaxed">
                                <section>
                                    <p>{!! nl2br(e($event->content)) !!}</p>
                                </section>
                            </main>
                            <footer class="flex justify-center mt-4">
                                @if (auth()->check())
                                    @if ($event->isUserSubscribed(auth()->user()))
                                        <p class="cursor-default font-semibold text-green-600">✅ Já inscrito</p>
                                    @else
                                        <a class="text-blue-600 hover:text-blue-400 font-semibold underline transition"
                                            href="{{ route('event-registration.create', ['event' => $event]) }}">📢 Participar</a>
                                    @endif
                                    
                                @endif
                                @if (!auth()->check())

                                    <a class="text-blue-400 hover:text-blue-300 underline transition"
                                        href="{{ route('login') }}">🔗Faça login para participar</a>
                                @endif
                            </footer>
                        </div>
                    </section>
                </div>
            </main>
        <x-footer/>
    </body>
</html> 
