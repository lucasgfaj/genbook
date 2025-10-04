<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>@yield('title', 'GenBook')</title>
</head>

<body class="bg-gray-100 text-gray-800 font-sans">

    <header class="bg-blue-700 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
            <h1 class="text-2xl font-bold"><img src="{{ asset('images/genbook.png') }}" alt="GenBook"
                    class="inline h-8 w-auto"> GenBook</h1>
            <nav class="space-x-4 flex items-center">
                <a href="#" class="flex items-center space-x-1 hover:underline">
                    <span>Início</span>
                </a>
                <a href="#" class="flex items-center space-x-1 hover:underline">
                    <span>Sobre</span>
                </a>
                <a href="#" class="flex items-center space-x-1 hover:underline">
                    <span>Contato</span>
                </a>
            </nav>

        </div>
    </header>

    <main">
        @yield('content')
    </main>

    <footer class="bg-blue-800 text-white">
        <div class="max-w-7xl mx-auto px-4 py-6 flex flex-col md:flex-row items-center justify-between">
            <p class="text-sm">&copy; {{ date('Y') }} GenBook. Todos os direitos reservados.</p>
            <div class="space-x-4 mt-2 md:mt-0">
                <a href="#" class="text-sm hover:underline">Política de Privacidade</a>
                <a href="#" class="text-sm hover:underline">Termos de Uso</a>
            </div>
        </div>
    </footer>

    @stack('scripts')

</body>

</html>