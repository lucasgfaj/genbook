@extends('layouts.authenticated')

@section('title', 'GenBook')

@section('content')

<div class="container mx-auto p-6">
  <h2 class="text-2xl font-semibold mb-6">Dashboard</h2>

  <!-- Cards Resumo -->
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    <!-- Livros Disponíveis -->
    <div class="bg-white shadow rounded-xl p-4 flex items-center space-x-4">
      <i class="bi bi-book text-4xl text-blue-600"></i>
      <div>
        <p class="text-gray-500 text-sm">Livros Disponíveis</p>
        <p class="text-2xl font-bold">230</p>
      </div>
    </div>

    <!-- Usuários Ativos -->
    <div class="bg-white shadow rounded-xl p-4 flex items-center space-x-4">
      <i class="bi bi-people-fill text-4xl text-green-600"></i>
      <div>
        <p class="text-gray-500 text-sm">Usuários Ativos</p>
        <p class="text-2xl font-bold">125</p>
      </div>
    </div>

    <!-- Empréstimos -->
    <div class="bg-white shadow rounded-xl p-4 flex items-center space-x-4">
      <i class="bi bi-journal-arrow-down text-4xl text-yellow-500"></i>
      <div>
        <p class="text-gray-500 text-sm">Empréstimos</p>
        <p class="text-2xl font-bold">87</p>
      </div>
    </div>

    <!-- Atrasos -->
    <div class="bg-white shadow rounded-xl p-4 flex items-center space-x-4">
      <i class="bi bi-exclamation-triangle-fill text-4xl text-red-600"></i>
      <div>
        <p class="text-gray-500 text-sm">Atrasos</p>
        <p class="text-2xl font-bold">5</p>
      </div>
    </div>
  </div>

  <!-- Conteúdo Principal -->
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
    <!-- Tabela de Empréstimos -->
    <div class="lg:col-span-2 bg-white shadow rounded-xl p-5">
      <h5 class="text-lg font-semibold mb-4">Empréstimos Recentes</h5>
      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="bg-gray-100 text-gray-700 text-sm">
              <th class="py-2 px-3">Aluno</th>
              <th class="py-2 px-3">Item/Livro</th>
              <th class="py-2 px-3">Data</th>
              <th class="py-2 px-3">Devolução</th>
              <th class="py-2 px-3">Status</th>
            </tr>
          </thead>
          <tbody class="divide-y">
            <tr class="hover:bg-gray-50">
              <td class="py-2 px-3">Lucas Ferreira</td>
              <td class="py-2 px-3">HTML e CSS - Jon Duckett</td>
              <td class="py-2 px-3">20/05/2025</td>
              <td class="py-2 px-3">27/05/2025</td>
              <td class="py-2 px-3">
                <span class="px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">
                  Ativo
                </span>
              </td>
            </tr>
            <tr class="hover:bg-gray-50">
              <td class="py-2 px-3">Maria Santos</td>
              <td class="py-2 px-3">JavaScript Avançado</td>
              <td class="py-2 px-3">15/05/2025</td>
              <td class="py-2 px-3">22/05/2025</td>
              <td class="py-2 px-3">
                <span class="px-2 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded-full">
                  Atrasado
                </span>
              </td>
            </tr>
            <tr class="hover:bg-gray-50">
              <td class="py-2 px-3">Pedro Oliveira</td>
              <td class="py-2 px-3">Python para Iniciantes</td>
              <td class="py-2 px-3">10/05/2025</td>
              <td class="py-2 px-3">17/05/2025</td>
              <td class="py-2 px-3">
                <span class="px-2 py-1 text-xs font-semibold text-gray-700 bg-gray-100 rounded-full">
                  Devolvido
                </span>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Painel de Alertas -->
    <div class="bg-white shadow rounded-xl p-5">
      <h5 class="text-lg font-semibold mb-4">Alertas</h5>

      <div class="flex items-center p-3 mb-3 rounded-lg bg-red-100 text-red-800">
        <i class="bi bi-exclamation-circle-fill mr-2"></i>
        <span>5 livros estão com devolução atrasada!</span>
      </div>

      <div class="flex items-center p-3 mb-3 rounded-lg bg-yellow-100 text-yellow-800">
        <i class="bi bi-clock-history mr-2"></i>
        <span>2 empréstimos vencem amanhã.</span>
      </div>

      <div class="flex items-center p-3 rounded-lg bg-blue-100 text-blue-800">
        <i class="bi bi-info-circle-fill mr-2"></i>
        <span>Novos livros foram adicionados ao acervo.</span>
      </div>
    </div>
  </div>
</div>

@endsection