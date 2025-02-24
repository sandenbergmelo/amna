<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Deletar notícia</title>
</head>

<body>
    <form action="{{ route('news.destroy', $news) }}" method="post">
        @csrf
        @method('delete')
        <div>
            <p>Deletar notícia</p>
            <p>Tem certeza que deseja deletar a notícia {{ $news->title }}?</p>
            <p>Essa ação não poderá ser desfeita.</p>
        </div>
        <div>
            <input type="submit" value="Deletar">
            <a href="{{ route('dashboard') }}">Cancelar</a>
        </div>
    </form>
</body>

</html>
