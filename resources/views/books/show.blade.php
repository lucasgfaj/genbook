@extends('layouts.authenticated')

@section('content')
  <div class="max-w-5xl mx-auto mt-10 mb-20 bg-white shadow-md rounded-2xl p-8">

    <div class="flex justify-between items-center mb-6">
      <h2 class="text-2xl font-bold flex items-center gap-2 text-blue-700">
        <i data-lucide="book"></i>
        Detalhes do Livro
      </h2>

      <a href="{{ url('/books') }}"
        class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100 flex items-center gap-2 text-gray-700">
        <i data-lucide="arrow-left"></i>
        Voltar
      </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div>
        <label class="block text-sm font-semibold mb-1">Título</label>
        <input type="text" class="w-full border border-gray-200 bg-gray-100 rounded-lg p-2 cursor-not-allowed"
          value="{{ $book->title }}" disabled>
      </div>

      <div>
        <label class="block text-sm font-semibold mb-1">
          {{ $book->authors->count() > 1 ? 'Autores(as)' : 'Autor(a)' }}
        </label>
        <input type="text" class="w-full border border-gray-200 bg-gray-100 rounded-lg p-2 cursor-not-allowed"
          value="{{ $book->authors->pluck('full_name')->join(', ') }}" disabled>
      </div>

      <div>
        <label class="block text-sm font-semibold mb-1">Editora</label>
        <input type="text" class="w-full border border-gray-200 bg-gray-100 rounded-lg p-2 cursor-not-allowed"
          value="{{ $book->publisher }}" disabled>
      </div>

      <div>
        <label class="block text-sm font-semibold mb-1">ISBN</label>
        <input type="text" class="w-full border border-gray-200 bg-gray-100 rounded-lg p-2 cursor-not-allowed"
          value="{{ $book->isbn }}" disabled>
      </div>

      <div>
        <label class="block text-sm font-semibold mb-1">Ano</label>
        <input type="text" class="w-full border border-gray-200 bg-gray-100 rounded-lg p-2 cursor-not-allowed"
          value="{{ $book->year }}" disabled>
      </div>

      <div>
        <label class="block text-sm font-semibold mb-1">Quantidade</label>
        <input type="number" class="w-full border border-gray-200 bg-gray-100 rounded-lg p-2 cursor-not-allowed"
          value="{{ $book->quantity }}" disabled>
      </div>

      <div>
        <label class="block text-sm font-semibold mb-1">Localização</label>
        <input type="text" class="w-full border border-gray-200 bg-gray-100 rounded-lg p-2 cursor-not-allowed"
          value="{{ $book->shelf_location }}" disabled>
      </div>

      <div>
        <label class="block text-sm font-semibold mb-1">Status</label>
        <input type="text" class="w-full border border-gray-200 bg-gray-100 rounded-lg p-2 cursor-not-allowed"
          value="{{ $book->is_active ? 'Ativo' : 'Inativo' }}" disabled>
      </div>

      <div class="col-span-2">
        <label class="block text-sm font-semibold mb-1">Capa Atual</label>
        <img src="{{ asset($book->cover_path ?? 'images/default-cover.jpg') }}" alt="Capa do Livro"
          class="rounded-lg border shadow max-h-64 mt-2 object-cover">
      </div>
    </div>

    <div class="flex justify-end mt-6">
      <a href="{{ url('/books/' . $book->id . '/edit') }}"
        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center gap-2 shadow-sm transition-all">
        <i data-lucide="pencil"></i>
        Editar
      </a>
    </div>
  </div>

@endsection