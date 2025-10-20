@extends('layouts.authenticated')

@section('title', 'GenBook')

@section('content')
  <div class="max-w-6xl mx-auto mt-10 mb-20 bg-white shadow-md rounded-2xl p-8">

    <div class="flex justify-between items-center mb-6">
      <h2 class="text-2xl font-bold flex items-center gap-2 text-blue-700">
        <i data-lucide="book"></i> Adicionar Novo Livro
      </h2>
      <a href="{{ route('books.index') }}"
        class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100 flex items-center gap-2 text-gray-700">
        <i data-lucide="arrow-left"></i> Voltar
      </a>
    </div>

    <form id="addBookForm" method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data" novalidate
      class="space-y-6">
      @csrf

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div>
          <label for="bookTitle" class="block text-sm font-semibold mb-1">Título</label>
          <input type="text" id="bookTitle" name="book[title]" required
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
            value="{{ old('book.title') }}">
        </div>

        <div>
          <label class="block text-sm font-semibold mb-1">Autores</label>
          <select name="authors[]" multiple required
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @foreach($authors as $author)
              <option value="{{ $author->id }}" {{ in_array($author->id, old('authors', [])) ? 'selected' : '' }}>
                {{ $author->full_name }}
              </option>
            @endforeach
          </select>
          <small class="text-gray-500">Segure Ctrl (ou Cmd) para selecionar múltiplos autores</small>
        </div>

        <div>
          <label class="block text-sm font-semibold mb-1">Categoria</label>
          <select name="book[category_id]" required
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <option value="">Selecione uma categoria</option>
            @foreach($categories as $category)
              <option value="{{ $category->id }}" {{ old('book.category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
              </option>
            @endforeach
          </select>
        </div>

        <div>
          <label for="bookYear" class="block text-sm font-semibold mb-1">Ano de Publicação</label>
          <input type="number" id="bookYear" name="book[year]" min="0" required
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
            value="{{ old('book.year') }}">
        </div>

        <div>
          <label for="bookISBN" class="block text-sm font-semibold mb-1">ISBN</label>
          <input type="text" id="bookISBN" name="book[isbn]" required
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
            value="{{ old('book.isbn') }}">
        </div>

        <div>
          <label for="validityDate" class="block text-sm font-semibold mb-1">Data de Validade</label>
          <input type="date" id="validityDate" name="book[validity_date]"
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
            value="{{ old('book.validity_date') }}">
        </div>

        <div>
          <label for="bookEdition" class="block text-sm font-semibold mb-1">Edição</label>
          <input type="text" id="bookEdition" name="book[edition]" required
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
            value="{{ old('book.edition') }}">
        </div>

        <div>
          <label for="bookPublisher" class="block text-sm font-semibold mb-1">Editora</label>
          <input type="text" id="bookPublisher" name="book[publisher]" required
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
            value="{{ old('book.publisher') }}">
        </div>

        <div>
          <label for="bookShelf" class="block text-sm font-semibold mb-1">Local na Estante</label>
          <input type="text" id="bookShelf" name="book[shelf_location]" required
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
            value="{{ old('book.shelf_location') }}">
        </div>

        <div>
          <label for="bookQuantity" class="block text-sm font-semibold mb-1">Quantidade</label>
          <input type="number" id="bookQuantity" name="book[quantity]" min="1" required
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
            value="{{ old('book.quantity') }}">
        </div>

        <div>
          <label for="bookImage" class="block text-sm font-semibold mb-1">Imagem do Livro</label>
          <input type="file" id="bookImage" name="book[cover_name]" accept="image/*"
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

      </div>

      <div class="flex justify-end gap-3 pt-6">
        <a href="{{ route('books.index') }}"
          class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">Cancelar</a>
        <button type="submit"
          class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center gap-2">
          <i data-lucide="check-circle"></i> Adicionar Livro
        </button>
      </div>

    </form>
  </div>
@endsection