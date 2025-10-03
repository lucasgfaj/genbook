@extends('layouts.app')

@section('title', 'GenBook')

@section('content')
<div class="min-h-screen flex flex-col md:flex-row">
    <!-- Login Section -->
    <div class="w-full md:w-1/2 flex items-center justify-center bg-white p-8">
        <div class="w-full max-w-md">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Bem-vindo de volta ao <span class="text-blue-600">GenBook</span></h2>

            @if(session('error'))
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label for="login" class="block text-gray-700 font-semibold mb-2">Usuário ou E-mail</label>
                    <input type="text" name="login" id="login" required
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-500"
                        value="{{ old('login') }}">
                    @error('login')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-gray-700 font-semibold mb-2">Senha</label>
                    <input type="password" name="password" id="password" required
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-500">
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition duration-200">
                    Entrar
                </button>
            </form>
        </div>
    </div>

    <!-- Info Section -->
    <div class="hidden md:flex md:w-1/2 bg-blue-50 items-center justify-center p-8">
        <div class="text-center max-w-md">
            <img src="https://source.unsplash.com/400x300/?books,library" alt="GenBook" class="rounded-lg shadow mb-6 w-full h-auto">
            <h2 class="text-2xl font-bold text-blue-700 mb-2">GenBook</h2>
            <p class="text-gray-700 mb-4">A solução moderna para gerenciar sua biblioteca escolar com eficiência e praticidade.</p>
            <ul class="text-left text-gray-600 space-y-2">
                <li>✅ Empréstimo e devolução de livros</li>
                <li>✅ Relatórios e histórico de uso</li>
                <li>✅ Controle de usuários e notificações</li>
            </ul>
        </div>
    </div>
</div>
@endsection
