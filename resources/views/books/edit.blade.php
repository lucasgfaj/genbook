@extends('layouts.authenticated')

@section('content')
<div class="max-w-6xl mx-auto mt-10 mb-20 bg-white shadow-md rounded-2xl p-8">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold flex items-center gap-2 text-blue-700">
            <i data-lucide="pencil"></i> Editar Livro
        </h2>
        <a href="{{ route('books.index') }}"
           class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100 flex items-center gap-2 text-gray-700">
            <i data-lucide="arrow-left"></i> Voltar
        </a>
    </div>

    <form action="{{ route('books.update', $book) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Título -->
            <div>
                <label for="bookTitle" class="block text-sm font-semibold mb-1">Título</label>
                <input type="text" id="bookTitle" name="book[title]"
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                       required value="{{ old('book.title', $book->title) }}">
                @error('book.title') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <!-- Autores -->
            <div>
                <label class="block text-sm font-semibold mb-1">Autores</label>
                <select name="authors[]" multiple required
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    @foreach ($authors as $author)
                        <option value="{{ $author->id }}"
                            {{ in_array($author->id, old('authors', $book->authors->pluck('id')->toArray())) ? 'selected' : '' }}>
                            {{ $author->full_name }}
                        </option>
                    @endforeach
                </select>
                <small class="text-gray-500">Segure Ctrl (ou Cmd) para selecionar múltiplos autores</small>
                @error('authors') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <!-- Categoria -->
            <div>
                <label class="block text-sm font-semibold mb-1">Categoria</label>
                <select name="book[category_id]" required
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Selecione uma categoria</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('book.category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('book.category_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <!-- Ano -->
            <div>
                <label for="bookYear" class="block text-sm font-semibold mb-1">Ano de Publicação</label>
                <input type="number" id="bookYear" name="book[year]" min="0" required
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                       value="{{ old('book.year', $book->year) }}">
                @error('book.year') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <!-- ISBN -->
            <div>
                <label for="bookISBN" class="block text-sm font-semibold mb-1">ISBN</label>
                <input type="text" id="bookISBN" name="book[isbn]" required
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                       value="{{ old('book.isbn', $book->isbn) }}">
                @error('book.isbn') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <!-- Data de validade -->
            <div>
                <label for="validityDate" class="block text-sm font-semibold mb-1">Data de Validade</label>
                <input type="date" id="validityDate" name="book[validity_date]"
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                       value="{{ old('book.validity_date', $book->validity_date) }}">
                @error('book.validity_date') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <!-- Edição -->
            <div>
                <label for="bookEdition" class="block text-sm font-semibold mb-1">Edição</label>
                <input type="text" id="bookEdition" name="book[edition]" required
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                       value="{{ old('book.edition', $book->edition) }}">
                @error('book.edition') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <!-- Editora -->
            <div>
                <label for="bookPublisher" class="block text-sm font-semibold mb-1">Editora</label>
                <input type="text" id="bookPublisher" name="book[publisher]" required
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                       value="{{ old('book.publisher', $book->publisher) }}">
                @error('book.publisher') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <!-- Local na Estante -->
            <div>
                <label for="bookShelf" class="block text-sm font-semibold mb-1">Local na Estante</label>
                <input type="text" id="bookShelf" name="book[shelf_location]" required
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                       value="{{ old('book.shelf_location', $book->shelf_location) }}">
                @error('book.shelf_location') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <!-- Quantidade -->
            <div>
                <label for="bookQuantity" class="block text-sm font-semibold mb-1">Quantidade</label>
                <input type="number" id="bookQuantity" name="book[quantity]" min="1" required
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                       value="{{ old('book.quantity', $book->quantity) }}">
                @error('book.quantity') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <!-- Capa Atual -->
            <div class="col-span-2">
                <label class="block text-sm font-semibold mb-1">Capa Atual</label>
                <img src="{{ $book->cover_name ? asset('storage/'.$book->cover_name) : asset('images/default-cover.jpg') }}"
                     alt="Capa do Livro"
                     class="rounded-lg border shadow max-h-64 mt-2 object-cover">
            </div>

            <!-- Nova Imagem -->
            <div class="col-span-2">
                <label for="bookImage" class="block text-sm font-semibold mb-1">Alterar Capa</label>
                <input type="file" id="bookImage" name="book[cover_name]" accept="image/*"
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('book.cover_name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

        </div>

        <!-- Botões -->
        <div class="flex justify-end mt-6 gap-3">
            <a href="{{ route('books.index') }}"
               class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">Cancelar</a>
            <button type="submit"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 flex items-center gap-2">
                <i data-lucide="check-circle"></i> Salvar Alterações
            </button>
        </div>

    </form>
</div>
@endsection
