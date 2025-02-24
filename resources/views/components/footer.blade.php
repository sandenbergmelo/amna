<footer class="w-full flex justify-center bg-amna-primary-100">
    <div class="w-amna-app text-white">
        <div class="flex flex-col pb-8 lg:grid lg:grid-cols-3 lg:py-8">
            <div class="hidden lg:flex">
                <p class="text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati tenetur incidunt possimus illum quia enim nemo magni animi officia quibusdam, debitis corporis numquam delectus recusandae, sapiente nam aliquid neque reprehenderit.</p>
            </div>
            <div class="flex justify-center items-start my-4">
                <a class="lg:text-7xl font-serif text-white px-7 flex" href="{{ route('home') }}">
                    <img class="h-12 lg:h-amna-logo" src="{{ asset('logos/logo_white.png') }}" alt="Logo da associação">
                    <p class="lg:hidden text-5xl">AMNA</p>
                </a>
            </div>
            <div class="flex justify-center items-center lg:justify-end pt-4">
                <a class="mx-2" href=""><img class="h-6 w-6 lg:h-8 lg:w-8" src="{{ asset('logos/facebook.png') }}" alt="logo facebook"></a>
                <a class="mx-2" href=""><img class="h-6 w-6 lg:h-8 lg:w-8" src="{{ asset('logos/twitter.png') }}" alt="logo twitter"></a>
                <a class="mx-2" href=""><img class="h-6 w-6 lg:h-8 lg:w-8" src="{{ asset('logos/instagram.png') }}" alt="logo instagram"></a>
                <a class="mx-2" href=""><img class="h-6 w-6 lg:h-8 lg:w-8" src="{{ asset('logos/linkedin.png') }}" alt="logo linkedin"></a>
                <a class="mx-2" href=""><img class="h-6 w-6 lg:h-8 lg:w-8" src="{{ asset('logos/github.svg') }}" alt="logo github"></a>
            </div>
        </div>
    </div>
</footer>