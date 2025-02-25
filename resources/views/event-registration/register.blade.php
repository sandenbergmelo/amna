<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrar no Evento</title>
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="w-full h-full flex justify-center items-center flex-col">
    <main class="lg:w-amna-app md:w-w-amna-app-content-md min-h-[50rem] text-black flex justify-start items-center flex-col md:justify-center mt-4 md:mt-0">
        <div class="py-4 w-full md:w-[25rem] md:shadow-2xl rounded-md transition-all duration-200">
            <div class="h-full w-full">
                <div>
                    <a class="text-7xl font-serif w-full flex justify-start items-center bg-white text-black px-7" href="{{ route('home') }}">
                        <img class="h-20" src="{{ asset('logos/logo.png') }}" alt="Logo da associação">
                        AMNA
                    </a>
                </div>
                <div class="w-full h-8 px-7 my-6 text-lg flex justify-start items-start">
                    <h1>Se registrar no evento</h1>
                </div>
                <div class="px-7 w-full">

                    <form class="flex justify-start items-start flex-col" action="{{ route('event-registration.store') }}" method="POST">
                        @csrf
                        <div>
                            <input type="hidden" name="event_id" value="{{ $event->id }}">
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <input type="hidden" name="registration_date" value="{{ \Carbon\Carbon::now()->toDateString() }}">
                        </div>
                        <div>
                            <p>Olá, <span class="font-bold">{{ $user->name }}</span>! Seja bem-vindo ao evento {{ $event->title }}</p>
                        </div>
                        <div class="w-full py-2">
                            <p class="font-bold">Confirma sua presença?</p>
                            <input type="radio" name="status_presence" value="Confirmed" id="Confirmed">
                            <label for="Confirmed">Sim, confirmo minha presença</label>
                        </div>
                        <div class="w-full py-2">
                            <input type="radio" name="status_presence" value="Pending" id="Pending">
                            <label for="Pending">Ainda não tenho certeza (fica como pendente)</label>
                        </div>
                        
                        <div class="w-full flex justify-start flex-col">
                            <a class="bg-red-700 hover:bg-red-600 text-white text-center font-semibold py-1 px-3 border rounded transition duration-300 cursor-pointer" href="{{ route('events.index') }}">Cancelar</a>
                            <input class="bg-amna-terciary-600 hover:bg-amna-terciary-500 text-white text-center font-semibold py-1 px-3 my-4 border rounded transition duration-300 cursor-pointer" type="submit" value="Registrar">
                        </div>
                        <div class="text-red-600">
                            @error('status_presence')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                            @error('registration_date')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        <script>           
                            document.addEventListener("DOMContentLoaded", function() {
                                let inputs = document.querySelectorAll("input, select, textarea");

                                inputs.forEach(input => {
                                    input.addEventListener("focus", function() {
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
</body>
</html>


