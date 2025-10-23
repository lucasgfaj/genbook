@extends('layouts.public')


@section('content')

    <div class="min-h-screen flex flex-col md:flex-row bg-cover bg-center relative"
        style="background-image: url('{{ asset('images/background.jpg') }}');">
        <div class="absolute inset-0 bg-black/40">
        </div>

        <div class="w-full md:w-1/2 flex items-center justify-center p-8 md:p-12 relative z-10">
            <div class="w-full max-w-md bg-white/90 rounded-xl shadow-md p-6 md:p-8">
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 mb-4 md:mb-6 text-center">
                    Bem-vindo(a) ao <br><span class="text-blue-600 writing typing">GenBook</span>
                </h2>

                @if(session('error'))
                    <div class="bg-red-100 text-red-700 p-2 rounded mb-4 text-center font-semibold text-sm">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('auth') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="auth" class="block text-gray-700 font-medium mb-1 text-sm">E-mail ou usuário</label>
                        <input type="text" name="auth" id="auth" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 shadow-sm text-sm"
                            value="{{ old('auth') }}">
                        @error('auth')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 font-medium mb-1 text-sm">Senha</label>
                        <input type="password" name="password" id="password" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 shadow-sm text-sm">
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="w-full bg-gradient-to-r from-blue-600 to-blue-500 text-white py-2 rounded-lg font-semibold shadow hover:from-blue-700 hover:to-blue-600 transition duration-200 transform hover:-translate-y-0.5 text-sm">
                        Entrar
                    </button>
                </form>

            </div>
        </div>

        <div class="hidden md:flex md:w-1/2 items-center justify-center p-6 relative z-10">
            <div
                class="max-w-md w-full space-y-6 text-center bg-white/20 backdrop-blur-sm border-white/30 rounded-xl p-8 shadow-lg">

                <h3 class="text-2xl font-bold text-white mb-2">Recursos do GenBook</h3>
                <p class="text-white/80 text-base mb-6">
                    Gerencie sua biblioteca escolar com eficiência e praticidade. Tenha controle completo de usuários,
                    livros e histórico de empréstimos.
                </p>

                <ul class="flex flex-col space-y-4">
                    <li class="flex items-center space-x-3">
                        <i data-lucide="book-open" class="w-5 h-5 text-blue-300"></i>
                        <span class="text-white/80 font-medium text-sm">Empréstimo e devolução de livros</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <i data-lucide="bar-chart-3" class="w-5 h-5 text-green-300"></i>
                        <span class="text-white/80 font-medium text-sm">Relatórios e histórico de uso</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <i data-lucide="users" class="w-5 h-5 text-purple-300"></i>
                        <span class="text-white/80 font-medium text-sm">Controle de usuários e notificações</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <i data-lucide="calendar" class="w-5 h-5 text-yellow-300"></i>
                        <span class="text-white/80 font-medium text-sm">Agendamento de reservas de livros</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <i data-lucide="bell" class="w-5 h-5 text-red-300"></i>
                        <span class="text-white/80 font-medium text-sm">Notificações de atraso ou novidades</span>
                    </li>
                </ul>
            </div>
        </div>

    </div>
@endsection