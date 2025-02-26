<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Início</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="w-full h-full flex justify-center items-center flex-col bg-gray-100">
        <x-header/>
        <main class="w-full h-full text-black flex justify-center items-center flex-col lg:w-amna-app ">
            <div class="mt-4">
                <x-carousel/>
            </div>
            <div class="w-full flex flex-col justify-between text-justify my-1 px-5 lg:flex-row md:flex-col lg:my-6 lg:px-0 lg:w-amna-app md:w-w-amna-app-content-md">
                <div class="w-full h-full bg-white my-6 p-5 rounded-[0.625rem] lg:w-amna-content-lg">
                    <h2 class="text-3xl lg:text-4xl font-bold text-[#010360] pb-4">Bem-Vindo à AMNA</h2>
                    <p>AMNA - Associação de Moradores do Novo Altiplano Iguatu-CE A associação de moradores do NovoAltiplano, foi iniciada  através da necessidade de resolução para muitos problemas encontrados no bairro. O loteamento Novo Altiplano, lançado em 2015, completa em 2025, sua primeira década de existência. No decorrer desses anos, não observamos melhorias e, com o crescente número de moradores,  cresceu, também,  a necessidade de áreas de convivência. Em meados de 2024, foi entregue o primeiro equipamento público,  a Areninha,  que foi recebido com muito entusiasmo  mas, com preocupações também, pois poderia ser transformado em um ambiente de perturbação para os moradores do entorno. Foi neste momento,  que um grupo de moradores,  se reuniu com o intuito de buscar melhorias e segurança para o bairro. Este grupo,  deu início à mobilização de mais moradores, para reunir as demandas do local, o que deu origem ao I Encena - Encontro cultural e de empreendedores do Novo Altiplano. Desde então, o grupo segue procurando parcerias, autoridades e reunindo vizinhos em prol das mudanças para o bairro.</p>
                </div>
                <div class="flex flex-col w-full lg:w-[31.25rem] md:w-full">
                    <div class="bg-white my-1 p-5 rounded-[0.625rem] lg:my-6">
                        <h2 class="text-3xl lg:text-4xl font-bold text-[#010360] pb-2">Últimos Eventos</h2>
                        @foreach ($events as $event)
                            <section class="pb-2">
                                <div>
                                    <header>
                                        <h2 class="text-lg font-bold pb-1">{{ $event->title ?? 'Evento Sem Título' }}</h2>
                                    </header>
                                    <footer class="pb-2">
                                        <a href="{{ route('events.show', ['event' => $event]) }}"
                                            class="text-blue-400 hover:text-blue-300 underline transition">🔗 Abrir evento</a>
                                    </footer>
                                </div>
                            </section>
                        @endforeach
                    </div>
                    <div class="bg-white my-6 p-5 rounded-[0.625rem]">
                        <h2 class="text-3xl lg:text-4xl font-bold text-[#010360]">Últimas Notícias</h2>
                        @foreach ($news as $newsItem)
                        <section class="pb-2">
                            <div>
                                <header>
                                    <h3 class="text-lg font-bold pb-1">{{ $newsItem->title }}</h3>
                                </header>
                                <footer class="pb-2">
                                    <a class="text-blue-400 hover:text-blue-300 underline transition pt-2" href="{{ route('news.show', ['news' => $newsItem]) }}">🔗 Abrir notícia</a>
                                </footer>
                            </div>
                        </section>
                    @endforeach
                    </div>
                </div>
            </div>
        </main>
        <x-footer/>
    </body>
</html>
