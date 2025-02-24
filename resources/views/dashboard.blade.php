<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
</head>

<body>
    <h1>Dashboard</h1>
    <p>Welcome to the dashboard</p>
    <a href="{{ route('logout') }}">Logout</a>

    @session('success')
        <p>{{ session('success') }}</p>
    @endsession

    <section>
        <h2>Eventos que você está inscrito</h2>
        @if ($user->eventRegistrations->isEmpty())
            <p>Você não está inscrito em nenhum evento</p>
        @endif
        @foreach ($user->eventRegistrations as $event)
            <section style="border: 1px solid black; padding: 10px; margin-top: 10px; width: 50%;">
                <h3>{{ $event->title }}</h3>
                @if ($event->image_path)
                    <img src="{{ asset($event->image_path) }}" alt="{{ $event->title }}" style="max-width: 300px;">
                @endif
                <p>{{ $event->description }}</p>
                <p>Status: {{ $event->pivot->status_presence == 'Confirmed' ? 'Confirmado' : 'Pendente' }}</p>
                @if ($event->pivot->status_presence == 'Pending')
                    {{-- Confirm presence --}}
                    <form action="{{ route('event-registration.update', ['id' => $event->pivot->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status_presence" value="Confirmed">
                        <button type="submit">Confirmar presença</button>
                    </form>
                @else
                    {{-- Cancel presence --}}
                    <form action="{{ route('event-registration.update', ['id' => $event->pivot->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status_presence" value="Pending">
                        <button type="submit">Cancelar presença</button>
                    </form>
                @endif
            </section>
        @endforeach
    </section>

    {{-- List all news if user is admin with edit and delete links --}}
    @if ($user->isAdmin())
        <section>
            <h2>Notícias</h2>
            @error('create_news')
                <p>{{ $message }}</p>
            @enderror
            @error('edit_news')
                <p>{{ $message }}</p>
            @enderror
            <a href="{{ route('news.create') }}">Criar notícia</a>
            <ul>
                @foreach ($user->news as $newsItem)
                    <section style="border: 1px solid black; padding: 10px; margin-top: 10px; width: 50%;">
                        <h3>{{ $newsItem->title }}</h3>
                        <p>Postado por: {{ $newsItem->author->name }}</p>
                        <p>Data de criação: {{ \App\Helpers\DateHelper::formatDate($newsItem->created_at) }}</p>

                        @if ($newsItem->image_path)
                            <img src="{{ asset($newsItem->image_path) }}" alt="{{ $newsItem->title }}"
                                style="max-width: 300px;">
                        @endif
                        <p>{{ $newsItem->content }}</p>
                        <a href="{{ route('news.edit', ['news' => $newsItem]) }}">Editar</a>
                        <a href="{{ route('news.delete', ['news' => $newsItem->id]) }}">Deletar</a>
                    </section>
                @endforeach
            </ul>
        </section>
        <section>
            <h2>Eventos</h2>
            @error('create_event')
                <p>{{ $message }}</p>
            @enderror
            @error('edit_event')
                <p>{{ $message }}</p>
            @enderror
            <a href="{{ route('events.create') }}">Criar evento</a>
            <ul>
                @foreach ($events as $event)
                    <section style="border: 1px solid black; padding: 10px; margin-top: 10px; width: 50%;">
                        <h3>{{ $event->title }}</h3>
                        @if ($event->image_path)
                            <img src="{{ asset($event->image_path) }}" alt="{{ $event->title }}"
                                style="max-width: 300px;">
                        @endif
                        <p>{{ $event->description }}</p>
                        <a href="{{ route('events.edit', ['event' => $event]) }}">Editar</a>
                        <a href="{{ route('events.delete', ['event' => $event]) }}">Deletar</a>
                    </section>
                @endforeach

        </section>
    @endif
</body>

</html>
