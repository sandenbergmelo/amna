<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f1f1f1;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
        }

        label {
            font-weight: bold;
        }

        input {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 5px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        a {
            position: absolute;
            top: 10px;
            left: 10px;
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }

        span {
            color: red;
        }
    </style>
</head>

<body>
    <a href="{{ route('home') }}">Home</a>
    <h2>Login</h2>

    @error('name')
        <span>{{ $message }}</span>
    @enderror

    @error('email')
        <span>{{ $message }}</span>
    @enderror

    @error('password')
        <span>{{ $message }}</span>
    @enderror

    @error('profile_photo')
        <span>{{ $message }}</span>
    @enderror

    @error('error')
        <span>{{ $message }}</span>
    @enderror

    <form action="{{ route('login.store') }}" method="POST">
        @csrf
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <div>
            <label for="remember">Lembrar-se de mim: </label>
            <input type="checkbox" name="remember" id="remember">
        </div>
        <button type="submit">Login</button>
    </form>
</body>

</html>
