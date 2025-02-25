<header
    class="w-full flex flex-col justify-center items-center bg-white text-white border-gray-300 border-b shadow-md relative">
    <!-- Cabeçalho com logo e botão do menu -->
    <main class="w-full lg:w-amna-app md:w-w-amna-app-content-md">
        <div class="flex flex-col md:flex-row md:justify-center relative">
            <div class="flex h-full items-center justify-between py-6 px-7 w-full md:justify-center">
                <a class="text-7xl font-serif flex items-center text-black" href="{{ route('home') }}">
                    <img class="h-amna-logo" src="{{ asset('logos/logo.png') }}" alt="Logo da associação">
                    AMNA
                </a>
                <!-- Botão só visível no mobile -->
                <button id="mobile-menu-button" class="md:hidden focus:outline-none hidden">
                    <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
            {{-- Foto do perfil --}}
            <div
                class="w-full md:w-auto h-full pb-4 px-4 flex justify-end md:px-0 md:pb-0 md:absolute md:top-0 md:right-0 text-black">
                @if (auth()->check())
                    <div class="flex justify-center items-center">
                        <button id="profile-button" type="button"
                            class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none">
                            <img class="w-10 h-10 border rounded-full border-black hover:bg-gray-400"
                                src="{{ asset(auth()->user()->profile_photo_path) }}" alt="{{ auth()->user()->name }}">
                        </button>

                        <!-- Dropdown -->
                        <div id="profile-dropdown"
                            class="hidden absolute right-0 top-full w-48 me-2 mt-2 bg-white border border-gray-300 rounded-md shadow-lg z-10 md:mt-0 md:me-0">
                            <a href="{{ route('dashboard') }}"
                                class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Dashboard</a>
                            @if (auth()->check())
                                @if (auth()->user()->isAdmin())
                                    <a href="{{ route('register') }}"
                                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Cadastrar novo
                                        usuário</a>
                                @endif
                            @endif
                            <a href="{{ route('logout') }}"
                                class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Desconectar</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <main>
</header>

<!-- Script para alternar a exibição do menu mobile e do dropdown do perfil -->
<script>
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        document.getElementById('mobile-nav').classList.toggle('hidden');
    });

    document.addEventListener("DOMContentLoaded", function() {
        const profileButton = document.getElementById("profile-button");
        const dropdown = document.getElementById("profile-dropdown");

        profileButton.addEventListener("click", function(event) {
            dropdown.classList.toggle("hidden");
            event.stopPropagation();
        });

        document.addEventListener("click", function(event) {
            if (!dropdown.contains(event.target) && !profileButton.contains(event.target)) {
                dropdown.classList.add("hidden");
            }
        });
    });
</script>
