<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Criar evento</title>
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
    <h1>Criar evento</h1>

    @error('title')
        <p>{{ $message }}</p>
    @enderror

    @error('description')
        <p>{{ $message }}</p>
    @enderror

    @error('start_date')
        <p>{{ $message }}</p>
    @enderror

    @error('end_date')
        <p>{{ $message }}</p>
    @enderror

    @error('image')
        <p>{{ $message }}</p>
    @enderror

    @error('error')
        <p>{{ $message }}</p>
    @enderror

    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="title">Título</label>
        <input type="text" name="title" id="title" required>

        <label for="description">Descrição</label>
        <textarea name="description" id="description" cols="30" rows="10" required></textarea>

        <label for="start_date">Data de início</label>
        <input type="date" name="start_date" id="start_date" required>

        <label for="end_date">Data de término</label>
        <input type="date" name="end_date" id="end_date" required>

        <label for="image">Imagem relacionada (opcional)</label>
        <input type="file" name="image" id="image" accept="image/*">

        <button type="submit">Criar</button>
    </form>
    <a href="{{ route('dashboard') }}">Voltar</a>
</body>

</html>
