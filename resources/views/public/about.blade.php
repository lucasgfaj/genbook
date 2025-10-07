@extends('layouts.public')

@section('title', 'Sobre Nós - GenBook')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-10 rounded-2xl shadow-lg mt-10 mb-10">

    <header class="border-b pb-6 mb-8">
        <h1 class="text-4xl font-extrabold text-blue-700">Sobre o GenBook</h1>
        <p class="mt-2 text-gray-600 text-lg">
            Conheça nossa missão, valores e história na criação da plataforma GenBook.
        </p>
    </header>

    <section class="mb-10">
        <h2 class="text-2xl font-semibold text-gray-800 mb-3">Nossa Missão</h2>
        <p class="text-gray-700 leading-relaxed">
            Tornar o acesso ao conhecimento mais simples e organizado, oferecendo uma experiência digital
            <span class="font-medium">intuitiva e confiável</span> para todos os envolvidos no processo de empréstimo de livros.
        </p>
    </section>

    <section class="mb-10">
        <h2 class="text-2xl font-semibold text-gray-800 mb-3">Nossos Valores</h2>
        <ul class="list-disc pl-6 text-gray-700 leading-relaxed">
            <li>Inovação constante no aprimoramento do sistema</li>
            <li>Segurança e confiabilidade das informações</li>
            <li>Compromisso com a acessibilidade e usabilidade</li>
            <li>Suporte eficiente aos usuários</li>
        </ul>
    </section>

    <section class="mb-10">
        <h2 class="text-2xl font-semibold text-gray-800 mb-3">Nossa História</h2>
        <p class="text-gray-700 leading-relaxed">
            Criado para atender bibliotecas acadêmicas e comunitárias, o GenBook nasceu como uma solução prática para gerenciar livros, usuários e empréstimos de maneira integrada e eficiente.
        </p>
    </section>

    <footer class="border-t pt-6 mt-8 text-sm text-gray-500">
        Última atualização: <span class="font-medium">{{ now()->format('d/m/Y') }}</span>
    </footer>
</div>
@endsection
