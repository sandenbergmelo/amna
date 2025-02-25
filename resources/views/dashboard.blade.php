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
    <x-dashboard.header />
    <main class="h-full mx-5 flex justify-start items-start flex-col md:justify-center md:items-center lg:w-amna-app">
        <section class="w-full flex flex-col py-4 lg:w-amna-content-lg md:w-amna-app-content-md">
            <div class="bg-white flex flex-col my-4 p-8 rounded-lg shadow-lg border-2 border-gray-300">
                <main class="w-full text-black flex flex-col justify-center items-center">
                    <div class="flex justify-center items-center">
                        <p class="text-lg font-bold pe-2"></p>
                        <img class="w-14 h-14 border rounded-full border-black hover:bg-gray-400"
                            src="{{ asset(auth()->user()->profile_photo_path) }}" alt="{{ auth()->user()->name }}">
                    </div>
                    <div class="w-full flex flex-col justify-center items-center pt-3">
                        <p class="text-lg font-bold">{{ $user->name }} </p>
                        <p class="text-lg font-bold">{{ $user->email }} </p>
                    </div>
                </main>
            </div>
        </section>
        <section>
            <div class="flex flex-col py-4 lg:w-amna-content-lg md:w-amna-app-content-md">
                @session('success')
                    <p class="text-green-400 py-4">{{ session('success') }}</p>
                @endsession
                <details class="w-full">
                    <summary class="text-3xl lg:text-4xl font-bold text-[#010360] cursor-pointer">Eventos que você está
                        inscrito</summary>
                    @if ($user->eventRegistrations->isEmpty())
                        <p>Você não está inscrito em nenhum evento</p>
                    @endif
                    @foreach ($user->eventRegistrations as $event)
                        <section
                            class="bg-white flex flex-col my-4 p-8 rounded-lg shadow-lg transition-all duration-200 hover:bg-gray-200 hover:scale-105 border-2 border-gray-300"
                            style="font-size: 1.2em;">
                            <h3 class="text-lg font-bold">{{ $event->title }}</h3>
                            @if ($event->image_path)
                                <img class="pe-4" src="{{ asset($event->image_path) }}" alt="{{ $event->title }}">
                            @endif
                            <p>{{ $event->description ?? 'Sem descrição disponível.' }}</p>
                            <p class="py-2">Status:
                                {{ $event->pivot->status_presence == 'Confirmed' ? 'Confirmado' : 'Pendente' }}</p>
                            @if ($event->pivot->status_presence == 'Pending')
                                {{-- Confirm presence --}}
                                <form action="{{ route('event-registration.update', ['id' => $event->pivot->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="w-full flex justify-start">
                                        <input type="hidden" name="status_presence" value="Confirmed">
                                        <button
                                            class="bg-amna-terciary-600 hover:bg-amna-terciary-500 text-white text-center font-semibold py-1 px-3 my-4 border rounded transition duration-300"
                                            type="submit">Confirmar presença</button>
                                    </div>
                                </form>
                            @else
                                {{-- Cancel presence --}}
                                <form action="{{ route('event-registration.update', ['id' => $event->pivot->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="w-full flex justify-start">
                                        <input type="hidden" name="status_presence" value="Pending">
                                        <button
                                            class="bg-amna-terciary-600 hover:bg-amna-terciary-500 text-white text-center font-semibold py-1 px-3 my-4 border rounded transition duration-300"
                                            type="submit">Cancelar presença</button>
                                    </div>
                                </form>
                            @endif
                        </section>
                    @endforeach
                </details>
            </div>
        </section>
        @if ($user->isAdmin())
            <section>
                <div class="flex flex-col py-4 lg:w-amna-content-lg md:w-amna-app-content-md">
                    @error('create_news')
                        <p>{{ $message }}</p>
                    @enderror
                    @error('edit_news')
                        <p>{{ $message }}</p>
                    @enderror
                    <details class="w-full">
                        <summary class="text-3xl lg:text-4xl font-bold text-[#010360] cursor-pointer">Notícias</summary>
                        <div class="bg-white flex flex-col my-4 p-8 rounded-lg shadow-lg border-2 border-gray-300">
                            <div class="text-black w-full">
                                <header class="mb-4">
                                    <h2 class="text-lg font-bold">Criar nova notícia</h2>
                                    <p class="pt-1">Para criar uma nova notícia basta clicar no botão abaixo.</p>
                                </header>
                                <a class="bg-amna-terciary-600 hover:bg-amna-terciary-500 text-white text-center font-semibold py-2 px-3 my-4 border rounded transition duration-300"
                                    href="{{ route('news.create') }}">Criar Notícia</a>
                            </div>
                        </div>
                        <section>
                            @foreach ($user->news as $newsItem)
                                <section
                                    class="bg-white flex flex-col my-4 p-8 rounded-lg shadow-lg transition-all duration-200 hover:bg-gray-200 hover:scale-105 border-2 border-gray-300"
                                    style="font-size: 1.2em;">
                                    <h3 class="text-lg font-bold">{{ $newsItem->title }}</h3>
                                    <p class="py-2">Postado por: {{ $newsItem->author->name }}</p>
                                    <p>Data de criação:
                                        {{ \App\Helpers\DateHelper::formatDateTime($newsItem->created_at) }}</p>

                                    @if ($newsItem->image_path)
                                        <img src="{{ asset($newsItem->image_path) }}" alt="{{ $newsItem->title }}"
                                            style="max-width: 300px;">
                                    @endif
                                    <p class="py-2">{{ $newsItem->description }}</p>
                                    <div class="w-full flex justify-start">
                                        <a class="bg-amna-terciary-600 hover:bg-amna-terciary-500 text-white text-center font-semibold py-1 px-3 my-4 me-4 border rounded transition duration-300"
                                            href="{{ route('news.edit', ['news' => $newsItem]) }}">Editar</a>
                                        <a class="bg-red-700 hover:bg-red-600 text-white text-center font-semibold py-1 px-3 my-4 border rounded transition duration-300"
                                            href="{{ route('news.delete', ['news' => $newsItem->id]) }}">Deletar</a>
                                    </div>
                                </section>
                            @endforeach
                        </section>
                    </details>
                </div>
        @endif
        @if ($user->isAdmin())
            </section>
            <section>
                <div class="flex flex-col py-4 lg:w-amna-content-lg md:w-amna-app-content-md">
                    @error('create_event')
                        <p>{{ $message }}</p>
                    @enderror
                    @error('edit_event')
                        <p>{{ $message }}</p>
                    @enderror
                    <details class="w-full">
                        <summary class="text-3xl lg:text-4xl font-bold text-[#010360] cursor-pointer">Eventos</summary>
                        <div class="bg-white flex flex-col my-4 p-8 rounded-lg shadow-lg border-2 border-gray-300">
                            <div class="text-black w-full">
                                <header class="mb-4">
                                    <h2 class="text-lg font-bold">Criar novo evento</h2>
                                    <p class="pt-1">Para criar uma novo evento basta clicar no botão abaixo.</p>
                                </header>
                                <a class="bg-amna-terciary-600 hover:bg-amna-terciary-500 text-white text-center font-semibold py-2 px-3 my-4 border rounded transition duration-300"
                                    href="{{ route('events.create') }}">Criar evento</a>
                            </div>
                        </div>
                        <section>
                            @foreach ($events as $event)
                                <section
                                    class="bg-white flex flex-col my-4 p-8 rounded-lg shadow-lg transition-all duration-200 hover:bg-gray-200 hover:scale-105 border-2 border-gray-300"
                                    style="font-size: 1.2em;">
                                    <h3 class="text-lg font-bold">{{ $event->title }}</h3>
                                    <div class="m-2">
                                        <h4>Início: {{ \App\Helpers\DateHelper::formatDate($event->start_date) }}</h4>
                                        <h4>Fim: {{ \App\Helpers\DateHelper::formatDate($event->end_date) }}</h4>
                                    </div>
                                    @if ($event->image_path)
                                        <img src="{{ asset($event->image_path) }}" alt="{{ $event->title }}"
                                            style="max-width: 300px;">
                                    @endif
                                    <p class="py-2">{{ $event->description }}</p>
                                    <div class="w-full flex justify-start ">
                                        <a class="bg-amna-terciary-600 hover:bg-amna-terciary-500 text-white text-center font-semibold py-1 px-3 my-4 me-4 border rounded transition duration-300"
                                            href="{{ route('events.edit', ['event' => $event]) }}">Editar</a>
                                        <a class="bg-red-700 hover:bg-red-600 text-white text-center font-semibold py-1 px-3 my-4 border rounded transition duration-300"
                                            href="{{ route('events.delete', ['event' => $event]) }}">Deletar</a>
                                    </div>
                                </section>
                            @endforeach
                        </section>
                    </details>
                </div>
            </section>
        @endif
    </main>
</body>

</html>
