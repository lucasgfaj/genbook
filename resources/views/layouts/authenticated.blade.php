<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'GenBook')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
</head>

<body class="bg-[#F9FAFB] text-gray-900 font-sans antialiased">

    <div class="flex h-screen">

        <aside class="w-64 bg-[#1E40AF] text-white flex flex-col px-4 py-6 fixed h-full overflow-y-auto">
            <div class="flex items-center mb-8">
                <i data-lucide="book-open" class="w-6 h-6 text-white mr-2"></i>
                <a href="/home" class="text-xl font-bold text-white">GenBook</a>
            </div>

            <nav class="flex-1">
                <ul class="space-y-1">
                    <li><a href="/dashboard"
                            class="flex items-center px-3 py-2 rounded-md hover:bg-[#3B82F6] text-white">
                            <i data-lucide="layout-dashboard" class="w-5 h-5 mr-2 text-white"></i> Dashboard</a></li>

                    <li><a href="/books" class="flex items-center px-3 py-2 rounded-md hover:bg-[#3B82F6] text-white">
                            <i data-lucide="book" class="w-5 h-5 mr-2 text-white"></i> Livros</a></li>

                    <li><a href="/materials"
                            class="flex items-center px-3 py-2 rounded-md hover:bg-[#3B82F6] text-white">
                            <i data-lucide="box" class="w-5 h-5 mr-2 text-white"></i> Materiais</a></li>

                    <li><a href="/authors" class="flex items-center px-3 py-2 rounded-md hover:bg-[#3B82F6] text-white">
                            <i data-lucide="users" class="w-5 h-5 mr-2 text-white"></i> Autores</a></li>

                    <li><a href="/categories"
                            class="flex items-center px-3 py-2 rounded-md hover:bg-[#3B82F6] text-white">
                            <i data-lucide="tags" class="w-5 h-5 mr-2 text-white"></i> Categorias</a></li>

                    <li><a href="/loans" class="flex items-center px-3 py-2 rounded-md hover:bg-[#3B82F6] text-white">
                            <i data-lucide="refresh-cw" class="w-5 h-5 mr-2 text-white"></i> Empréstimos</a></li>

                    <li><a href="/users" class="flex items-center px-3 py-2 rounded-md hover:bg-[#3B82F6] text-white">
                            <i data-lucide="user-circle" class="w-5 h-5 mr-2 text-white"></i> Usuários</a></li>

                    <li><a href="/reports" class="flex items-center px-3 py-2 rounded-md hover:bg-[#3B82F6] text-white">
                            <i data-lucide="bar-chart-3" class="w-5 h-5 mr-2 text-white"></i> Relatórios</a></li>

                    @if(auth()->user()?->admin)
                        <li><a href="/admin" class="flex items-center px-3 py-2 rounded-md hover:bg-[#3B82F6] text-white">
                                <i data-lucide="shield-check" class="w-5 h-5 mr-2 text-white"></i> Admin</a></li>
                    @endif

                    <li class="mt-6 text-xs font-semibold text-white uppercase opacity-80">Sistema</li>

                    <li><a href="/config" class="flex items-center px-3 py-2 rounded-md hover:bg-[#3B82F6] text-white">
                            <i data-lucide="settings" class="w-5 h-5 mr-2 text-white"></i> Configurações</a></li>

                    <li>
                        <form method="POST" action="{{ route('logout') }}" id="logout-form">
                            @csrf
                            <button type="submit"
                                class="w-full text-left flex items-center px-3 py-2 rounded-md hover:bg-red-600 text-white">
                                <i data-lucide="log-out" class="w-5 h-5 mr-2 text-white"></i> Sair
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </aside>

        <div class="flex flex-col flex-1 ml-64">

            <header
                class="flex items-center justify-between bg-[#1E40AF] shadow px-6 py-4 border-b border-gray-200 sticky top-0 z-10">
                <button class="menu-button lg:hidden">
                    <i data-lucide="list"></i>
                </button>

                <h1 class="text-lg font-semibold text-white">Painel</h1>

                <div class="flex items-center gap-6">
                    <div class="relative">
                        <button id="notifBtn" class="relative focus:outline-none">
                            <i data-lucide="bell" class="w-6 h-6 text-white"></i>
                            <span class="absolute top-0 right-0 block w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>

                        <div id="notifDropdown"
                            class="hidden absolute right-0 mt-2 w-80 bg-white border border-gray-200 rounded-lg shadow-lg z-20">
                            <div class="flex items-center justify-between px-4 py-2 border-b border-gray-100">
                                <span class="font-semibold text-gray-700">Notificações</span>
                                <a href="#" class="text-sm text-[#1E40AF] hover:underline">Marcar todas como lidas</a>
                            </div>

                            <div class="max-h-60 overflow-y-auto divide-y divide-gray-100">
                                <div class="p-3 text-sm text-gray-700 flex items-start gap-2">
                                    <i data-lucide="alert-circle" class="w-4 h-4 text-red-500 mt-1"></i>
                                    <div>
                                        <p><strong>Carlos Santos</strong> está com o livro <strong>“Harry Potter e a
                                                Pedra Filosofal”</strong> atrasado</p>
                                        <small class="text-gray-500">há 2 anos</small>
                                    </div>
                                </div>
                                <div class="p-3 text-sm text-gray-700 flex items-start gap-2">
                                    <i data-lucide="alert-triangle" class="w-4 h-4 text-yellow-500 mt-1"></i>
                                    <div>
                                        <p>Material <strong>“Kit de Química 101”</strong> está próximo da validade</p>
                                        <small class="text-gray-500">há 2 anos</small>
                                    </div>
                                </div>
                            </div>

                            <div class="px-4 py-2 text-center border-t border-gray-100 bg-gray-50">
                                <a href="#" class="text-sm text-[#1E40AF] hover:underline">Ver todas</a>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div
                            class="w-9 h-9 rounded-full bg-white text-[#1E40AF] flex items-center justify-center font-bold mr-2">
                            {{ strtoupper(substr(auth()->user()->full_name ?? 'U', 0, 1)) }}
                        </div>
                        <div>
                            <div class="font-semibold text-white">{{ auth()->user()->full_name ?? 'Usuário' }}</div>
                            <div class="text-sm text-white">{{ 'Bibliotecário(a)' }}</div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Conteúdo principal rolável -->
            <main class="flex-1 p-6 overflow-y-auto">
                @yield('content')
            </main>
        </div>
    </div>
    <script src="https://unpkg.com/lucide@latest"></script>
    @vite(['resources/js/authenticated.js'])
</body>

</html>