<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detalhes do evento</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        section {
            width: 50%;
        }

        a {
            margin-top: 10px;
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <h1>{{ $event->title }}</h1>

    <p> Data de início e término: {{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y') }} até
        {{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y') }}
    </p>

    <p>Horário de início e término: {{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} até
        {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }}
    </p>

    <h4>Local: {{ $event->location }}</h4>

    @if (auth()->check())
        @if ($event->isUserSubscribed(auth()->user()))
            <p class="cursor-default"><strong>Já inscrito</strong></p>
        @else
            <a class="text-blue-400 hover:text-blue-300 underline transition"
                href="{{ route('event-registration.create', ['event' => $event]) }}">Participar</a>
        @endif
    @endif

    @if ($event->image_path)
        <img src="{{ asset($event->image_path) }}" alt="{{ $event->title }}" style="max-width: 50%;">
    @endif

    <h3>{{ $event->description }}</h3>

    <section>
        <p>{!! nl2br(e($event->content)) !!}</p>
    </section>

    <a href="{{ route('events.index') }}">Voltar</a>
</body>

</html>
