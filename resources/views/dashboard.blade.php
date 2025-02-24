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

    {{-- List all news if user is admin --}}
    @if ($user->profile_type === 'admin')
        <section>
            <h2>News</h2>
            <ul>
                @foreach ($user->news as $new)
                    <li>{{ $new->title }}</li>
                @endforeach
            </ul>
        </section>
    @endif
</body>

</html>
