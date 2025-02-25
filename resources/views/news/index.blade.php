<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notícias</title>
</head>

<body>
    <section>
        <h2>Notícias</h2>
        <ul>
            @foreach ($news as $newsItem)
                <section style="border: 1px solid black; padding: 10px; margin-top: 10px; width: 50%;">
                    <h3>{{ $newsItem->title }}</h3>
                    <a href="{{ route('news.show', ['news' => $newsItem]) }}">Abrir notícia</a>
                    <p>Postado por: {{ $newsItem->author->name }}</p>
                    <p>Data de criação: {{ \App\Helpers\DateHelper::formatDateTime($newsItem->created_at) }}</p>

                    @if ($newsItem->image_path)
                        <img src="{{ asset($newsItem->image_path) }}" alt="{{ $newsItem->title }}"
                            style="max-width: 300px;">
                    @endif
                    <p>{{ $newsItem->description }}</p>
                </section>
            @endforeach
        </ul>
    </section>
</body>

</html>
