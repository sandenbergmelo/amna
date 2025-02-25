<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastro</title>
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="w-full h-full flex justify-center items-center flex-col">
    <x-header />
    <main class="m-4 lg:w-amna-app md:w-w-amna-app-content-md min-h-[50rem] text-black flex justify-start items-center flex-col md:justify-center mt-4 md:mt-0">
        <div class="py-4 w-full md:w-[25rem] md:shadow-2xl rounded-md transition-all duration-200">
            <div class="h-full w-full">
                <div class="w-full h-8 px-7 my-4 text-lg flex justify-center items-start">
                    <h2>Cadastrar uma nova conta</h2>
                </div>
                <div class="px-7 w-full">

                    <form class="flex justify-start items-start flex-col" action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="w-full py-2">
                            <label for="profile_photo">Imagem de perfil</label>
                            <input class="text-black text-center font-semibold py-2 transition duration-300 cursor-pointer" type="file" name="profile_photo" id="profile_photo" accept="image/*" required>
                        </div>
                        <div class="w-full py-2">
                            <label for="name">Nome</label>
                            <input class="bg-white py-2 px-4 w-full border border-black rounded" type="text" name="name" placeholder="Seu nome" required>
                        </div>
                        <div class="w-full py-2">
                            <label for="email">E-mail</label>
                            <input class="bg-white py-2 px-4 w-full border border-black rounded" type="email" name="email" placeholder="Seu e-mail" required>
                        </div>
                        <div class="w-full py-2">
                            <label for="password">Senha</label>
                            <input class="bg-white py-2 px-4 w-full border border-black rounded" type="password" name="password" id="password" placeholder="Sua senha" minlength="8" required>
                        </div>
                        <div class="w-full py-2">
                            <label for="password_again">Confirmar Senha</label>
                            <input class="bg-white py-2 px-4 w-full border border-black rounded" type="password" name="password_again" id="password_again" placeholder="Sua senha novamente" minlength="8" required>
                        </div>

                        @if (auth()->check())
                            @if (auth()->user()->profile_type == 'admin')
                        
                                <div class="w-full py-2">
                                    <p>O usuário é admin?</p>
                                    <div class="w-full flex">
                                        <div class="flex items-center pe-4">
                                            <label for="profile_type_yes">Sim</label>
                                            <input class="w-5 h-5 text-blue-600 bg-gray-100 focus:ring-blue-500 focus:ring-2 cursor-pointer" type="radio" name="profile_type" id="profile_type_yes" value="admin">
                                        </div>
                                        <div class="flex justify-start items-center">
                                            <label for="profile_type_no">Não</label>
                                            <input class="w-5 h-5 text-blue-600 bg-gray-100 focus:ring-blue-500 focus:ring-2 cursor-pointer" type="radio" name="profile_type" id="profile_type_no" value="resident">
                                        </div>
                                    </div>
                                </div>

                            @endif
                        @endif

                        <div class="w-full flex justify-start flex-col">
                            <input class="bg-amna-terciary-600 hover:bg-amna-terciary-500 text-white text-center font-semibold py-1 px-3 my-4 border rounded transition duration-300 cursor-pointer" type="submit" value="Cadastrar">
                        </div>

                        <div class="text-red-600">
                            @error('name')
                                <span class="error-message">{{ $message }}</span>
                            @enderror

                            @error('error')
                                <span class="error-message">{{ $message }}</span>
                            @enderror

                            @error('email')
                                <span class="error-message">{{ $message }}</span>
                            @enderror

                            @error('password')
                                <span class="error-message">{{ $message }}</span>
                            @enderror

                            @error('profile_photo')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <span class="border border-gray-500 w-full mt-8"></span>
                        <div class="bg-white w-full my-4 p-2">
                            <p>Já possui uma conta?</p>
                            <a class="text-blue-400 hover:text-blue-300 underline transition" href="{{ route('login') }}">Acesse agora mesmo</a>
                        </div>

                        <script>
                            document.addEventListener("DOMContentLoaded", function () {
                            const password = document.getElementById("password");
                            const passwordAgain = document.getElementById("password_again");

                            passwordAgain.addEventListener("input", function () {
                                if (password.value !== passwordAgain.value) {
                                    passwordAgain.setCustomValidity("As senhas não coincidem.");
                                } else {
                                    passwordAgain.setCustomValidity("");
                                }
                                });
                            });
         
                            document.addEventListener("DOMContentLoaded", function() {
                                // Seleciona todos os inputs do formulário
                                let inputs = document.querySelectorAll("input, select, textarea");

                                inputs.forEach(input => {
                                    input.addEventListener("focus", function() {
                                        // Esconde todas as mensagens de erro
                                        document.querySelectorAll(".error-message").forEach(error => {
                                            error.style.display = "none";
                                        });
                                    });
                                });
                            });


                        </script>
                    </form>  
                </div>
            </div>
        </div>
    </main>
    <x-footer />
</body>
</html>

