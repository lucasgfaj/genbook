@extends('layouts.public')

@section('title', 'Política de Privacidade - GenBook')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-10 rounded-2xl shadow-lg mt-10 mb-10">

    <header class="border-b pb-6 mb-8">
        <h1 class="text-4xl font-extrabold text-blue-700">Política de Privacidade</h1>
        <p class="mt-2 text-gray-600 text-lg">
            Como o GenBook coleta, utiliza e protege suas informações pessoais.
        </p>
    </header>

    <section class="mb-10">
        <h2 class="text-2xl font-semibold text-gray-800 mb-3">1. Coleta de Informações</h2>
        <p class="text-gray-700 leading-relaxed">
            Coletamos informações como <span class="font-medium">nome, e-mail, usuário e histórico de empréstimos</span> de livros
            para melhorar a experiência dos usuários e garantir o bom funcionamento do sistema.
        </p>
    </section>

    <section class="mb-10">
        <h2 class="text-2xl font-semibold text-gray-800 mb-3">2. Uso das Informações</h2>
        <p class="text-gray-700 leading-relaxed">
            Os dados coletados são utilizados exclusivamente para <span class="font-medium">fins administrativos</span>, como controle
            de usuários, registros de atividades e envio de notificações importantes.
        </p>
    </section>

    <section class="mb-10">
        <h2 class="text-2xl font-semibold text-gray-800 mb-3">3. Segurança</h2>
        <p class="text-gray-700 leading-relaxed">
            Adotamos medidas de segurança <span class="font-medium">técnicas e administrativas</span> para proteger suas informações
            contra acessos não autorizados, alterações ou destruição indevida.
        </p>
    </section>

    <section class="mb-10">
        <h2 class="text-2xl font-semibold text-gray-800 mb-3">4. Alterações</h2>
        <p class="text-gray-700 leading-relaxed">
            Esta política pode ser atualizada periodicamente. Recomendamos que você
            <span class="font-medium">revise esta página regularmente</span> para se manter informado.
        </p>
    </section>

    <footer class="border-t pt-6 mt-8 text-sm text-gray-500">
        Última atualização: <span class="font-medium">{{ now()->format('d/m/Y') }}</span>
    </footer>
</div>
@endsection
