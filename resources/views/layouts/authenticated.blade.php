<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'GenBook')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-900 font-sans antialiased">

    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md flex flex-col px-4 py-6 border-r border-gray-200">
            <div class="flex items-center mb-8">
                <i data-lucide="book-open" class="w-6 h-6 text-blue-600 mr-2"></i>
                <a href="/home" class="text-xl font-bold text-gray-800">GenBook</a>
            </div>

            <nav class="flex-1">
                <ul class="space-y-1">
                    <li><a href="/home" class="flex items-center px-3 py-2 rounded-md hover:bg-blue-50 text-gray-700 hover:text-blue-600">
                        <i data-lucide="layout-dashboard" class="w-5 h-5 mr-2"></i> Dashboard</a></li>

                    <li><a href="/books" class="flex items-center px-3 py-2 rounded-md hover:bg-blue-50 text-gray-700 hover:text-blue-600">
                        <i data-lucide="book" class="w-5 h-5 mr-2"></i> Livros</a></li>

                    <li><a href="/materials" class="flex items-center px-3 py-2 rounded-md hover:bg-blue-50 text-gray-700 hover:text-blue-600">
                        <i data-lucide="box" class="w-5 h-5 mr-2"></i> Materiais</a></li>

                    <li><a href="/authors" class="flex items-center px-3 py-2 rounded-md hover:bg-blue-50 text-gray-700 hover:text-blue-600">
                        <i data-lucide="users" class="w-5 h-5 mr-2"></i> Autores</a></li>

                    <li><a href="/categories" class="flex items-center px-3 py-2 rounded-md hover:bg-blue-50 text-gray-700 hover:text-blue-600">
                        <i data-lucide="tags" class="w-5 h-5 mr-2"></i> Categorias</a></li>

                    <li><a href="/loans" class="flex items-center px-3 py-2 rounded-md hover:bg-blue-50 text-gray-700 hover:text-blue-600">
                        <i data-lucide="refresh-cw" class="w-5 h-5 mr-2"></i> Empréstimos</a></li>

                    <li><a href="/users" class="flex items-center px-3 py-2 rounded-md hover:bg-blue-50 text-gray-700 hover:text-blue-600">
                        <i data-lucide="user-circle" class="w-5 h-5 mr-2"></i> Usuários</a></li>

                    <li><a href="/reports" class="flex items-center px-3 py-2 rounded-md hover:bg-blue-50 text-gray-700 hover:text-blue-600">
                        <i data-lucide="bar-chart-3" class="w-5 h-5 mr-2"></i> Relatórios</a></li>

                    @if(auth()->user()?->admin)
                    <li><a href="/admin" class="flex items-center px-3 py-2 rounded-md hover:bg-blue-50 text-gray-700 hover:text-blue-600">
                        <i data-lucide="shield-check" class="w-5 h-5 mr-2"></i> Admin</a></li>
                    @endif

                    <li class="mt-6 text-xs font-semibold text-gray-500 uppercase">Sistema</li>

                    <li><a href="/config" class="flex items-center px-3 py-2 rounded-md hover:bg-blue-50 text-gray-700 hover:text-blue-600">
                        <i data-lucide="settings" class="w-5 h-5 mr-2"></i> Configurações</a></li>

              <li>
    <form method="POST" action="{{ route('logout') }}" id="logout-form">
        @csrf
        <button type="submit"
                class="w-full text-left flex items-center px-3 py-2 rounded-md hover:bg-red-50 text-gray-700 hover:text-red-600">
            <i data-lucide="log-out" class="w-5 h-5 mr-2"></i> Sair
        </button>
    </form>
</li>         </ul>
            </nav>
        </aside>

        <!-- Conteúdo principal -->
        <div class="flex flex-col flex-1">

            <!-- Header -->
            <header class="flex items-center justify-between bg-white shadow px-6 py-4 border-b border-gray-200 sticky top-0 z-10">
                <h1 class="text-lg font-semibold text-gray-800">Painel</h1>

                <div class="flex items-center gap-6">
                    <!-- Notificações -->
                    <div class="relative">
                        <button id="notifBtn" class="relative focus:outline-none">
                            <i data-lucide="bell" class="w-6 h-6 text-gray-700"></i>
                            <span class="absolute top-0 right-0 block w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>

                        <!-- Dropdown de notificações -->
                        <div id="notifDropdown"
                            class="hidden absolute right-0 mt-2 w-80 bg-white border border-gray-200 rounded-lg shadow-lg z-20">
                            <div class="flex items-center justify-between px-4 py-2 border-b border-gray-100">
                                <span class="font-semibold text-gray-700">Notificações</span>
                                <a href="#" class="text-sm text-blue-600 hover:underline">Marcar todas como lidas</a>
                            </div>

                            <div class="max-h-60 overflow-y-auto divide-y divide-gray-100">
                                <div class="p-3 text-sm text-gray-700 flex items-start gap-2">
                                    <i data-lucide="alert-circle" class="w-4 h-4 text-red-500 mt-1"></i>
                                    <div>
                                        <p><strong>Carlos Santos</strong> está com o livro <strong>“Harry Potter e a Pedra Filosofal”</strong> atrasado</p>
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
                                <a href="#" class="text-sm text-blue-600 hover:underline">Ver todas</a>
                            </div>
                        </div>
                    </div>

                    <!-- Usuário -->
                    <div class="flex items-center">
                        <div class="w-9 h-9 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold mr-2">
                            {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                        </div>
                        <div>
                            <div class="font-semibold text-gray-800">{{ auth()->user()->name ?? 'Usuário' }}</div>
                            <div class="text-sm text-gray-500">{{ auth()->user()->role ?? 'Bibliotecário(a)' }}</div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Conteúdo dinâmico -->
            <main class="flex-1 p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        // Toggle dropdown de notificações
        const btn = document.getElementById('notifBtn');
        const dropdown = document.getElementById('notifDropdown');
        btn.addEventListener('click', () => dropdown.classList.toggle('hidden'));
        window.addEventListener('click', (e) => {
            if (!btn.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });
    </script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>
</body>

</html>
