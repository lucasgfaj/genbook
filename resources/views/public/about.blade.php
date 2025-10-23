@extends('layouts.public')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow-md mt-8 mb-8">

    <header class="border-b pb-4 mb-6">
        <h1 class="text-2xl font-bold text-blue-700">Sobre o GenBook</h1>
        <p class="mt-1 text-gray-600 text-base">
            Conheça nossa missão, valores e história na criação da plataforma GenBook.
        </p>
    </header>

    <section class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-2">Nossa Missão</h2>
        <p class="text-gray-700 text-sm leading-relaxed">
            Tornar o acesso ao conhecimento mais simples e organizado, oferecendo uma experiência digital
            <span class="font-medium">intuitiva e confiável</span> para todos os envolvidos no processo de empréstimo de livros.
        </p>
    </section>

    <section class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-2">Nossos Valores</h2>
        <ul class="list-disc pl-5 text-gray-700 text-sm leading-relaxed">
            <li>Inovação constante no aprimoramento do sistema</li>
            <li>Segurança e confiabilidade das informações</li>
            <li>Compromisso com a acessibilidade e usabilidade</li>
            <li>Suporte eficiente aos usuários</li>
        </ul>
    </section>

    <section class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-2">Nossa História</h2>
        <p class="text-gray-700 text-sm leading-relaxed">
            Criado para atender bibliotecas acadêmicas e comunitárias, o GenBook nasceu como uma solução prática para gerenciar livros, usuários e empréstimos de maneira integrada e eficiente.
        </p>
    </section>

    <footer class="border-t pt-4 mt-6 text-xs text-gray-500">
        Última atualização: <span class="font-medium">{{ now()->format('d/m/Y') }}</span>
    </footer>
</div>
@endsection
