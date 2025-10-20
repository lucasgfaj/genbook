<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ Vite::asset('resources/images/favicon.ico') }}">
    <title>@yield('title', 'GenBook')</title>
</head>

<body class="bg-[#F9FAFB] text-gray-800 font-sans">

    <header class="bg-[#1E40AF] text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
            <!-- Logo -->
            <a href="{{ route('auth') }}" class="flex items-center space-x-2">
                <img src="{{ asset('images/genbook.png') }}" alt="GenBook" class="inline h-8 w-auto">
                <h1 class="text-2xl font-bold inline">GenBook</h1>
            </a>

            <nav class="space-x-6 flex items-center">
                <a href="{{ route('auth') }}" class="hover:text-[#3B82F6] transition-colors">Início</a>
                <a href="{{ route('about') }}" class="hover:text-[#3B82F6] transition-colors">Sobre</a>
                <a href="{{ route('contact') }}" class="hover:text-[#3B82F6] transition-colors">Contato</a>
            </nav>
        </div>
    </header>

    <main class="min-h-screen  mx-auto">
        @yield('content')
    </main>

    <footer class="bg-[#1E40AF] text-white">
        <div class="max-w-7xl mx-auto px-4 py-6 flex flex-col md:flex-row items-center justify-between">
            <p class="text-sm">&copy; {{ date('Y') }} GenBook. Todos os direitos reservados.</p>
            <div class="space-x-4 mt-2 md:mt-0">
                <a href="{{ route('policies') }}" class="text-sm hover:text-[#3B82F6] transition-colors">Política de
                    Privacidade</a>
                <a href="{{ route('terms') }}" class="text-sm hover:text-[#3B82F6] transition-colors">Termos de Uso</a>
                <a href="{{ route('contact') }}" class="text-sm hover:text-[#3B82F6] transition-colors">Contato</a>
                <a href="{{ route('about') }}" class="text-sm hover:text-[#3B82F6] transition-colors">Sobre</a>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>

</body>

</html>