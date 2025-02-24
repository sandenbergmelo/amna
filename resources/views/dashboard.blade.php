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

    {{-- List all news if user is admin with edit and delete links --}}
    @if ($user->isAdmin())
        <h2>Notícias</h2>
        @error('create_news')
            <p>{{ $message }}</p>
        @enderror
        <a href="{{ route('news.create') }}">Criar notícia</a>
        <ul>
            @foreach ($user->news as $newsItem)
                <section style="border: 1px solid black; padding: 10px; margin-top: 10px; width: 50%;">
                    <h3>{{ $newsItem->title }}</h3>
                    @if ($newsItem->image_path)
                        <img src="{{ asset($newsItem->image_path) }}" alt="{{ $newsItem->title }}"
                            style="max-width: 300px;">
                    @endif
                    <p>{{ $newsItem->content }}</p>
                    {{-- <a href="{{ route('news.edit', ['news' => $newsItem->id]) }}">Editar</a> --}}
                    {{-- <a href="{{ route('news.destroy', ['news' => $newsItem->id]) }}">Deletar</a> --}}
                </section>
            @endforeach
        </ul>
    @endif
</body>

</html>
