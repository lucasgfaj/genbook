@extends('layouts.app')

@section('title', 'Contato - GenBook')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-10 rounded-2xl shadow-lg mt-10 mb-20">

    <header class="border-b pb-6 mb-8">
        <h1 class="text-4xl font-extrabold text-blue-700">Fale Conosco</h1>
        <p class="mt-2 text-gray-600 text-lg">
            Entre em contato com a equipe do GenBook para dúvidas, sugestões ou suporte.
        </p>
    </header>

    <section class="mb-10">
        <h2 class="text-2xl font-semibold text-gray-800 mb-3">E-mail</h2>
        <p class="text-gray-700 leading-relaxed">
            Envie suas mensagens para: 
            <a href="mailto:suporte@genbook.com" class="text-blue-600 hover:underline">suporte@genbook.com</a>
        </p>
    </section>

    <section class="mb-10">
        <h2 class="text-2xl font-semibold text-gray-800 mb-3">Telefone</h2>
        <p class="text-gray-700 leading-relaxed">
            Ligue para nosso suporte: <span class="font-medium">(11) 1234-5678</span>
        </p>
    </section>

    <section class="mb-10">
        <h2 class="text-2xl font-semibold text-gray-800 mb-3">Endereço</h2>
        <p class="text-gray-700 leading-relaxed">
            Rua Exemplo, 123, Bairro Central, São Paulo, SP, Brasil
        </p>
    </section>

    <section class="mb-10">
        <h2 class="text-2xl font-semibold text-gray-800 mb-3">Formulário de Contato</h2>
        <p class="text-gray-700 leading-relaxed">
            Em breve teremos um formulário direto aqui para facilitar o envio de mensagens.
        </p>
    </section>

    <footer class="border-t pt-6 mt-8 text-sm text-gray-500">
        Última atualização: <span class="font-medium">{{ now()->format('d/m/Y') }}</span>
    </footer>
</div>
@endsection
