@extends('layouts.public')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow-md mt-8 mb-12">

    <!-- Header -->
    <header class="border-b pb-4 mb-6">
        <h1 class="text-2xl font-bold text-blue-700">Termos de Uso</h1>
        <p class="mt-1 text-gray-600 text-base">
            Condições para utilização da plataforma GenBook por usuários e administradores.
        </p>
    </header>

    <!-- Section 1 -->
    <section class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-2">1. Aceitação dos Termos</h2>
        <p class="text-gray-700 text-sm leading-relaxed">
            Ao utilizar o GenBook, você <span class="font-medium">concorda integralmente com estes termos</span> e se compromete
            a respeitar todas as condições aqui estabelecidas.
        </p>
    </section>

    <!-- Section 2 -->
    <section class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-2">2. Uso Adequado</h2>
        <p class="text-gray-700 text-sm leading-relaxed">
            É <span class="font-medium">estritamente proibido</span> utilizar o sistema para fins ilegais, ofensivos
            ou que violem direitos de terceiros ou da instituição responsável.
        </p>
    </section>

    <!-- Section 3 -->
    <section class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-2">3. Responsabilidades</h2>
        <ul class="list-disc pl-5 text-gray-700 text-sm leading-relaxed">
            <li>Empréstimos e devoluções de livros</li>
            <li>Alterações cadastrais</li>
            <li>Manutenção da segurança de suas credenciais de acesso</li>
        </ul>
    </section>

    <!-- Section 4 -->
    <section class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-2">4. Modificações</h2>
        <p class="text-gray-700 text-sm leading-relaxed">
            Estes termos poderão ser alterados a qualquer momento.
            <span class="font-medium">Notificações oficiais serão enviadas aos usuários</span>
            sempre que houver mudanças significativas.
        </p>
    </section>

    <!-- Footer -->
    <footer class="border-t pt-4 mt-6 text-xs text-gray-500">
        Última atualização: <span class="font-medium">{{ now()->format('d/m/Y') }}</span>
    </footer>
</div>
</div>
@endsection
