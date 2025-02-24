<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Se registrar no evento</title>
</head>

<body>
    <h1>Se registrar no evento</h1>
    <p>Olá, {{ $user->name }}! Seja bem-vindo ao evento {{ $event->title }}</p>

    @error('status_presence')
        <p style="color: red;">{{ $message }}</p>
    @enderror
    @error('registration_date')
        <p style="color: red;">{{ $message }}</p>
    @enderror

    <form action="{{ route('event-registration.store') }}" method="POST">
        @csrf
        <input type="hidden" name="event_id" value="{{ $event->id }}">
        <input type="hidden" name="user_id" value="{{ $user->id }}">
        <input type="hidden" name="registration_date" value="{{ \Carbon\Carbon::now()->toDateString() }}">

        <p>Confirma sua presença?</p>
        <input type="radio" name="status_presence" value="Confirmed" id="Confirmed">
        <label for="Confirmed">Sim, confirmo minha presença</label><br>

        <input type="radio" name="status_presence" value="Pending" id="Pending">
        <label for="Pending">Ainda não tenho certeza (fica como pendente)</label><br>

        <a href="{{ route('events.index') }}">Cancelar</a>
        <button type="submit">Registrar</button>
</body>

</html>
