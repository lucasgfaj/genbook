@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow-md mt-8 mb-12">

    <header class="border-b pb-4 mb-6">
        <h1 class="text-2xl font-bold text-blue-700">Fale Conosco</h1>
        <p class="mt-1 text-gray-600 text-base">
            Entre em contato com a equipe do GenBook para dúvidas, sugestões ou suporte.
        </p>
    </header>

    <section class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-2">E-mail</h2>
        <p class="text-gray-700 text-sm leading-relaxed">
            Envie suas mensagens para:
            <a href="mailto:suporte@genbook.com" class="text-blue-600 hover:underline">suporte@genbook.com</a>
        </p>
    </section>

    <section class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-2">Telefone</h2>
        <p class="text-gray-700 text-sm leading-relaxed">
            Ligue para nosso suporte: <span class="font-medium">(11) 1234-5678</span>
        </p>
    </section>

    <section class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-2">Endereço</h2>
        <p class="text-gray-700 text-sm leading-relaxed">
            Rua Exemplo, 123, Bairro Central, São Paulo, SP, Brasil
        </p>
    </section>

    <section class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-2">Formulário de Contato</h2>
        <p class="text-gray-700 text-sm leading-relaxed">
            Em breve teremos um formulário direto aqui para facilitar o envio de mensagens.
        </p>
    </section>

    <footer class="border-t pt-4 mt-6 text-xs text-gray-500">
        Última atualização: <span class="font-medium">{{ now()->format('d/m/Y') }}</span>
    </footer>
</div>
@endsection
