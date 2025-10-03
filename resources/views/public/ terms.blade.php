@extends('layouts.app')

@section('title', 'Termos de Uso - GenBook')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded shadow">
    <h1 class="text-3xl font-bold mb-4 text-blue-700">Termos de Uso</h1>
    <p class="mb-4 text-gray-700">
        Estes Termos de Uso regulam a utilização do sistema GenBook por parte dos usuários registrados e administradores.
    </p>

    <h2 class="text-xl font-semibold mt-6 mb-2 text-gray-800">1. Aceitação dos Termos</h2>
    <p class="text-gray-700 mb-4">
        Ao utilizar o GenBook, você concorda com os presentes termos e se compromete a respeitá-los integralmente.
    </p>

    <h2 class="text-xl font-semibold mt-6 mb-2 text-gray-800">2. Uso Adequado</h2>
    <p class="text-gray-700 mb-4">
        É proibido utilizar o sistema para fins ilegais, ofensivos ou que violem direitos de terceiros ou da instituição responsável.
    </p>

    <h2 class="text-xl font-semibold mt-6 mb-2 text-gray-800">3. Responsabilidades</h2>
    <p class="text-gray-700 mb-4">
        O usuário é responsável pelas ações realizadas com sua conta, incluindo empréstimos, devoluções e alterações cadastrais.
    </p>

    <h2 class="text-xl font-semibold mt-6 mb-2 text-gray-800">4. Modificações</h2>
    <p class="text-gray-700 mb-4">
        Estes termos podem ser alterados a qualquer momento. Notificações serão feitas aos usuários sempre que houver atualizações significativas.
    </p>

    <p class="text-sm text-gray-500 mt-6">Última atualização: {{ now()->format('d/m/Y') }}</p>
</div>
@endsection
