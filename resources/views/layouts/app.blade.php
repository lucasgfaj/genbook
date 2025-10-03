<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>@yield('title', 'Meu Site')</title>
</head>

<body class="bg-gray-100 text-gray-800 font-sans">

    <!-- Header -->
    <header class="bg-blue-700 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
            <h1 class="text-2xl font-bold">📘 GenBook</h1>
            <nav class="space-x-4">
                <a href="#" class="hover:underline">Início</a>
                <a href="#" class="hover:underline">Sobre</a>
                <a href="#" class="hover:underline">Contato</a>
            </nav>
        </div>
    </header>

    <!-- Conteúdo principal -->
    <main class="py-10 px-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-blue-800 text-white mt-10">
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
