@extends('layouts.app')

@section('title', 'Política de Privacidade - GenBook')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded shadow">
    <h1 class="text-3xl font-bold mb-4 text-blue-700">Política de Privacidade</h1>
    <p class="mb-4 text-gray-700">
        Esta Política de Privacidade descreve como o GenBook coleta, usa e protege as informações fornecidas pelos usuários ao utilizar nossa plataforma.
    </p>

    <h2 class="text-xl font-semibold mt-6 mb-2 text-gray-800">1. Coleta de Informações</h2>
    <p class="text-gray-700 mb-4">
        Coletamos informações como nome, e-mail, usuário e histórico de empréstimos de livros para melhorar a experiência e garantir o bom funcionamento do sistema.
    </p>

    <h2 class="text-xl font-semibold mt-6 mb-2 text-gray-800">2. Uso das Informações</h2>
    <p class="text-gray-700 mb-4">
        As informações são utilizadas exclusivamente para fins administrativos, como controle de usuários, registros de atividades e notificações.
    </p>

    <h2 class="text-xl font-semibold mt-6 mb-2 text-gray-800">3. Segurança</h2>
    <p class="text-gray-700 mb-4">
        Adotamos medidas de segurança adequadas para proteger suas informações contra acessos não autorizados.
    </p>

    <h2 class="text-xl font-semibold mt-6 mb-2 text-gray-800">4. Alterações</h2>
    <p class="text-gray-700 mb-4">
        Reservamo-nos o direito de atualizar esta política a qualquer momento. Recomendamos que os usuários revisem esta página periodicamente.
    </p>

    <p class="text-sm text-gray-500 mt-6">Última atualização: {{ now()->format('d/m/Y') }}</p>
</div>
@endsection
