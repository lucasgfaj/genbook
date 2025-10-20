@extends('layouts.authenticated')

@section('title', 'GenBook')

@section('content')

<div class="max-w-5xl mx-auto mt-10 mb-20 bg-white shadow-md rounded-2xl p-8">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold flex items-center gap-2">
      <i class="bi bi-book"></i> Detalhes do Livro
    </h2>
    <a href="/books" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100 flex items-center gap-1 text-gray-700">
      <i class="bi bi-arrow-left"></i> Voltar
    </a>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
      <label class="block text-sm font-semibold mb-1">Título</label>
      <input type="text" class="w-full border-gray-200 bg-gray-100 rounded-lg" value="<?= $book->title ?>" disabled>
    </div>

    <div>
      <label class="block text-sm font-semibold mb-1"><?= count($book->authors) > 1 ? 'Autores(as)' : 'Autor(a)' ?></label>
      <input type="text" class="w-full border-gray-200 bg-gray-100 rounded-lg" value="<?= implode(', ', array_map(fn($a) => $a->full_name, $book->authors)) ?>" disabled>
    </div>

    <div>
      <label class="block text-sm font-semibold mb-1">Editora</label>
      <input type="text" class="w-full border-gray-200 bg-gray-100 rounded-lg" value="<?= $book->publisher ?>" disabled>
    </div>

    <div>
      <label class="block text-sm font-semibold mb-1">ISBN</label>
      <input type="text" class="w-full border-gray-200 bg-gray-100 rounded-lg" value="<?= $book->isbn ?>" disabled>
    </div>

    <div>
      <label class="block text-sm font-semibold mb-1">Ano</label>
      <input type="text" class="w-full border-gray-200 bg-gray-100 rounded-lg" value="<?= $book->year ?>" disabled>
    </div>

    <div>
      <label class="block text-sm font-semibold mb-1">Quantidade</label>
      <input type="number" class="w-full border-gray-200 bg-gray-100 rounded-lg" value="<?= $book->quantity ?>" disabled>
    </div>

    <div>
      <label class="block text-sm font-semibold mb-1">Localização</label>
      <input type="text" class="w-full border-gray-200 bg-gray-100 rounded-lg" value="<?= $book->shelf_location ?>" disabled>
    </div>

    <div>
      <label class="block text-sm font-semibold mb-1">Status</label>
      <input type="text" class="w-full border-gray-200 bg-gray-100 rounded-lg" value="<?= $book->is_active ? 'Ativo' : 'Inativo' ?>" disabled>
    </div>

    <div class="col-span-2">
      <label class="block text-sm font-semibold mb-1">Capa Atual</label>
      <img src="<?= $book->cover()->path() ?>" alt="Capa do Livro" class="rounded-lg border shadow max-h-64 mt-2">
    </div>
  </div>

  <div class="flex justify-end mt-6">
    <a href="/books/<?= $book->id ?>/edit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center gap-2">
      <i class="bi bi-pencil-square"></i> Editar
    </a>
  </div>
</div>
@endsection
