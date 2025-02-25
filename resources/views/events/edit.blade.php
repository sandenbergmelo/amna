<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar evento</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        form {
            display: flex;
            flex-direction: column;
            width: 50%;
        }

        label {
            margin-top: 10px;
        }

        input,
        textarea {
            margin-top: 5px;
            padding: 5px;
        }

        button {
            margin-top: 10px;
            padding: 5px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
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
    <h1>Editar evento</h1>

    @error('title')
        <p>{{ $message }}</p>
    @enderror

    @error('description')
        <p>{{ $message }}</p>
    @enderror

    @error('content')
        <p>{{ $message }}</p>
    @enderror

    @error('start_date')
        <p>{{ $message }}</p>
    @enderror

    @error('end_date')
        <p>{{ $message }}</p>
    @enderror

    @error('start_time')
        <p>{{ $message }}</p>
    @enderror

    @error('end_time')
        <p>{{ $message }}</p>
    @enderror

    @error('location')
        <p>{{ $message }}</p>
    @enderror

    @error('image')
        <p>{{ $message }}</p>
    @enderror

    @error('error')
        <p>{{ $message }}</p>
    @enderror

    <form action="{{ route('events.update', ['event' => $event]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <label for="title">Título</label>
        <input type="text" name="title" id="title" value="{{ $event->title }}" required>

        <label for="description">Mini Descrição</label>
        <textarea name="description" id="description" rows="3" required>{{ $event->description }}</textarea>

        <label for="content">Conteúdo</label>
        <textarea name="content" id="content" rows="10" required>{{ $event->content }}</textarea>

        <label for="start_date">Data de início</label>
        <input type="date" name="start_date" id="start_date" value="{{ $event->start_date }}" required>

        <label for="end_date">Data de término</label>
        <input type="date" name="end_date" id="end_date" value="{{ $event->end_date }}" required>

        <label for="start_time">Hora de início</label>
        <input type="time" name="start_time" id="start_time" value="{{ $event->start_time }}" required>

        <label for="end_time">Hora de término</label>
        <input type="time" name="end_time" id="end_time" value="{{ $event->end_time }}" required>

        <label for="location">Localização</label>
        <input type="text" name="location" id="location" value="{{ $event->location }}" required>

        <label for="image">Imagem relacionada (deixe em branco para manter a atual)</label>
        <input type="file" name="image" id="image" accept="image/*">

        <button type="submit">Salvar</button>
    </form>
    <a href="{{ route('dashboard') }}">Voltar</a>
</body>

</html>
