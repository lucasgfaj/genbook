@extends('layouts.app')

@section('title', 'Termos de Uso - GenBook')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-10 rounded-2xl shadow-lg mt-10 mb-10">
    <!-- Header -->
    <header class="border-b pb-6 mb-8">
        <h1 class="text-4xl font-extrabold text-blue-700">Termos de Uso</h1>
        <p class="mt-2 text-gray-600 text-lg">
            Condições para utilização da plataforma GenBook por usuários e administradores.
        </p>
    </header>

    <!-- Section 1 -->
    <section class="mb-10">
        <h2 class="text-2xl font-semibold text-gray-800 mb-3">1. Aceitação dos Termos</h2>
        <p class="text-gray-700 leading-relaxed">
            Ao utilizar o GenBook, você <span class="font-medium">concorda integralmente com estes termos</span> e se compromete
            a respeitar todas as condições aqui estabelecidas.
        </p>
    </section>

    <!-- Section 2 -->
    <section class="mb-10">
        <h2 class="text-2xl font-semibold text-gray-800 mb-3">2. Uso Adequado</h2>
        <p class="text-gray-700 leading-relaxed">
            É <span class="font-medium">estritamente proibido</span> utilizar o sistema para fins ilegais, ofensivos
            ou que violem direitos de terceiros ou da instituição responsável.
        </p>
    </section>

    <!-- Section 3 -->
    <section class="mb-10">
        <h2 class="text-2xl font-semibold text-gray-800 mb-3">3. Responsabilidades</h2>
        <p class="text-gray-700 leading-relaxed">
            O usuário é responsável por todas as ações realizadas com sua conta, incluindo:
            <ul class="list-disc pl-6 mt-3 text-gray-700">
                <li>Empréstimos e devoluções de livros</li>
                <li>Alterações cadastrais</li>
                <li>Manutenção da segurança de suas credenciais de acesso</li>
            </ul>
        </p>
    </section>

    <!-- Section 4 -->
    <section class="mb-10">
        <h2 class="text-2xl font-semibold text-gray-800 mb-3">4. Modificações</h2>
        <p class="text-gray-700 leading-relaxed">
            Estes termos poderão ser alterados a qualquer momento.
            <span class="font-medium">Notificações oficiais serão enviadas aos usuários</span>
            sempre que houver mudanças significativas.
        </p>
    </section>

    <!-- Footer -->
    <footer class="border-t pt-6 mt-8 text-sm text-gray-500">
        Última atualização: <span class="font-medium">{{ now()->format('d/m/Y') }}</span>
    </footer>
</div>
@endsection
