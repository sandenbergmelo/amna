<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Deletar usuário</title>
</head>

<body>
    <form action="{{ route('users.destroy', $user) }}" method="post">
        @csrf
        @method('delete')
        <div>
            <p>Deletar usuário</p>
            <p>Tem certeza que deseja deletar o usuário {{ $user->name }}?</p>
            <p>Essa ação não poderá ser desfeita.</p>
        </div>
        <div>
            <input type="submit" value="Deletar">
            <a href="{{ route('profile.index') }}">Cancelar</a>
        </div>
    </form>
</body>

</html>
