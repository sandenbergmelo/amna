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
    <section class="h-full flex justify-center items-center flex-col px-5 lg:w-amna-app">
            <div class="flex flex-col py-4 lg:w-amna-app md:w-amna-app-content-md">
                <details class="w-full">
                    <summary class="text-3xl lg:text-4xl font-bold text-[#010360] cursor-pointer">Eventos que você está inscrito</summary>
                    @session('success')
                        <p>{{ session('success') }}</p>
                    @endsession
                    @if ($user->eventRegistrations->isEmpty())
                        <p>Você não está inscrito em nenhum evento</p>
                    @endif
                    @foreach ($user->eventRegistrations as $event)
                        <section class="bg-white flex flex-col my-4 p-8 rounded-lg shadow-lg transition-all duration-200 hover:bg-gray-200 hover:scale-105 border-2 border-gray-300" style="font-size: 1.2em;">
                            <h3 class="text-lg font-bold">{{ $event->title }}</h3>
                            @if ($event->image_path)
                                <img class="pe-4" src="{{ asset($event->image_path) }}" alt="{{ $event->title }}">
                            @endif
                            <p>{{ $event->description ?? 'Sem descrição disponível.' }}</p>
                            <p class="py-2">Status: {{ $event->pivot->status_presence == 'Confirmed' ? 'Confirmado' : 'Pendente' }}</p>
                            @if ($event->pivot->status_presence == 'Pending')
                                {{-- Confirm presence --}}
                                <form action="{{ route('event-registration.update', ['id' => $event->pivot->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="w-full flex justify-start">
                                        <input type="hidden" name="status_presence" value="Confirmed">
                                        <button class="bg-amna-terciary-600 hover:bg-amna-terciary-500 text-white text-center font-semibold py-1 px-3 my-4 border rounded transition duration-300" type="submit">Confirmar presença</button>
                                    </div>
                                </form>
                            @else
                                {{-- Cancel presence --}}
                                <form action="{{ route('event-registration.update', ['id' => $event->pivot->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="w-full py-2 flex flex-col">
                                        <input type="hidden" name="status_presence" value="Pending">
                                        <button class="bg-amna-terciary-600 hover:bg-amna-terciary-500 text-white text-center font-semibold py-1 px-3 my-4 border rounded transition duration-300" type="submit">Cancelar presença</button>
                                    </div>
                                </form>
                            @endif
                        </section>
                    @endforeach
                </details>
            </div>
    </section>
    @if ($user->isAdmin())
    <section class="h-full flex justify-center items-center flex-col px-5 lg:w-amna-app">
        <div class="flex flex-col py-4 lg:w-amna-app md:w-amna-app-content-md">
            <details class="w-full">
                <summary class="text-3xl lg:text-4xl font-bold text-[#010360] cursor-pointer">Notícias</summary>
                @error('create_news')
                    <p>{{ $message }}</p>
                @enderror
                @error('edit_news')
                    <p>{{ $message }}</p>
                @enderror
                <div class="my-4">
                    <a class="bg-amna-terciary-600 hover:bg-amna-terciary-500 text-white text-center font-semibold py-3 px-3 my-4 border rounded transition duration-300" href="{{ route('news.create') }}">Criar notícia</a>
                </div>
                <section>
                    @foreach ($user->news as $newsItem)
                        <section class="bg-white flex flex-col my-4 p-8 rounded-lg shadow-lg transition-all duration-200 hover:bg-gray-200 hover:scale-105 border-2 border-gray-300" style="font-size: 1.2em;">
                            <h3 class="text-lg font-bold">{{ $newsItem->title }}</h3>
                            <p class="py-2">Postado por: {{ $newsItem->author->name }}</p>
                            <p>Data de criação: {{ \App\Helpers\DateHelper::formatDate($newsItem->created_at) }}</p>

                            @if ($newsItem->image_path)
                                <img src="{{ asset($newsItem->image_path) }}" alt="{{ $newsItem->title }}"
                                    style="max-width: 300px;">
                            @endif
                            <p class="py-2">{{ $newsItem->content }}</p>
                            <div class="w-full flex justify-start">
                                <a class="bg-amna-terciary-600 hover:bg-amna-terciary-500 text-white text-center font-semibold py-1 px-3 my-4 border rounded transition duration-300" href="{{ route('news.edit', ['news' => $newsItem]) }}">Editar</a>
                                <a class="bg-amna-terciary-600 hover:bg-amna-terciary-500 text-white text-center font-semibold py-1 px-3 my-4 border rounded transition duration-300" href="{{ route('news.delete', ['news' => $newsItem->id]) }}">Deletar</a>
                            </div>
                        </section>
                    @endforeach
                </section>
            </details>
        </div>
    @endif
    @if ($user->isAdmin())
    </section>
        <section class="h-full flex justify-center items-center flex-col px-5 lg:w-amna-app">
        <div class="flex flex-col py-4 lg:w-amna-app md:w-amna-app-content-md">
            <details class="w-full">
                <summary class="text-3xl lg:text-4xl font-bold text-[#010360] cursor-pointer">Eventos</summary>
                @error('create_event')
                    <p>{{ $message }}</p>
                @enderror
                @error('edit_event')
                    <p>{{ $message }}</p>
                @enderror
                <div class="my-4">
                    <a class="bg-amna-terciary-600 hover:bg-amna-terciary-500 text-white text-center font-semibold py-3 px-3 my-4 border rounded transition duration-300" href="{{ route('events.create') }}">Criar evento</a>
                </div>
                <section>
                    @foreach ($events as $event)
                        <section class="bg-white flex flex-col my-4 p-8 rounded-lg shadow-lg transition-all duration-200 hover:bg-gray-200 hover:scale-105 border-2 border-gray-300" style="font-size: 1.2em;">
                            <h3 class="text-lg font-bold">{{ $event->title }}</h3>
                            @if ($event->image_path)
                                <img src="{{ asset($event->image_path) }}" alt="{{ $event->title }}"
                                    style="max-width: 300px;">
                            @endif
                            <p class="py-2">{{ $event->description }}</p>
                            <div class="w-full flex justify-start">
                                <a class="bg-amna-terciary-600 hover:bg-amna-terciary-500 text-white text-center font-semibold py-1 px-3 my-4 border rounded transition duration-300" href="{{ route('events.edit', ['event' => $event]) }}">Editar</a>
                                <a class="bg-amna-terciary-600 hover:bg-amna-terciary-500 text-white text-center font-semibold py-1 px-3 my-4 border rounded transition duration-300" href="{{ route('events.delete', ['event' => $event]) }}">Deletar</a>
                            </div>
                        </section>
                    @endforeach
                </section>
            </details>
        </div>
    </section>
    @endif
</body>
</html>
