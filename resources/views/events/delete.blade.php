<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Deletar evento</title>
</head>

<body>
    <form action="{{ route('events.destroy', $event) }}" method="post">
        @csrf
        @method('delete')
        <div>
            <p>Deletar evento</p>
            <p>Tem certeza que deseja deletar o evento {{ $event->title }}?</p>
            <p>Essa ação não poderá ser desfeita.</p>
        </div>
        <div>
            <input type="submit" value="Deletar">
            <a href="{{ route('dashboard') }}">Cancelar</a>
        </div>
    </form>
</body>

</html>
