<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Eventos</title>
</head>

<body>
    <section>
        <h2>Eventos</h2>
        <ul>
            @foreach ($events as $event)
                <section style="border: 1px solid black; padding: 10px; margin-top: 10px; width: 50%;">
                    <h3>{{ $event->title }}</h3>
                    @if ($event->image_path)
                        <img src="{{ asset($event->image_path) }}" alt="{{ $event->title }}" style="max-width: 300px;">
                    @endif
                    <p>{{ $event->description }}</p>
                    {{--  Verifica se o usuário está inscrito no evento --}}
                    @if ($event->isUserSubscribed(auth()->user()))
                        <p>Já inscrito</p>
                    @else
                        <a href="{{ route('event-registration.create', ['event' => $event]) }}">Participar</a>
                    @endif
                </section>
            @endforeach
    </section>
</body>

</html>
