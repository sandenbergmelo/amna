<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detalhes da Notícia</title>

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
    <h1>{{ $news->title }}</h1>
    <p>Publicado por {{ $news->author->name }} em {{ $news->created_at->format('d/m/Y à\s H:i') }}</p>

    @if ($news->image_path)
        <img src="{{ asset($news->image_path) }}" alt="{{ $news->title }}" style="max-width: 50%;">
    @endif

    <h3>{{ $news->description }}</h3>

    <section>
        <p>{!! nl2br(e($news->content)) !!}</p>
    </section>

    <footer>
        @if ($news->external_link)
            <p>Link externo relacionado: <a href="{{ $news->external_link }}"
                    target="_blank">{{ $news->external_link }}</a></p>
        @endif
    </footer>

    <a href="{{ route('news.index') }}">Voltar</a>
</body>

</html>
