@extends('layouts.authenticated')

@section('title', 'GenBook')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
  <!-- Cabeçalho -->
  <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6">
    <h2 class="text-2xl font-bold text-gray-800 text-center md:text-left">Livros</h2>

    <form action="{{ route('books.index') }}" method="GET" class="flex flex-wrap items-stretch gap-3 justify-center md:justify-end w-full md:w-auto">
      <!-- Campo de busca -->
      <div class="flex items-center bg-white border border-gray-300 rounded-lg shadow-sm overflow-hidden w-full md:w-72">
        <span class="px-3 text-gray-500">
          <i class="bi bi-search"></i>
        </span>
        <input
          type="text"
          name="q"
          value="{{ request('q') }}"
          class="w-full px-3 py-2 text-gray-700 focus:outline-none"
          placeholder="Buscar livros..."
        >
      </div>

      <!-- Botão de buscar -->
      <button type="submit" class="flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition">
        <i class="bi bi-search"></i>
        Buscar
      </button>

      <!-- Botão de adicionar -->
      <a
        href="{{ route('books.new') }}"
        class="flex items-center gap-2 bg-yellow-500 text-white px-4 py-2 rounded-lg shadow hover:bg-yellow-600 transition"
      >
        <i class="bi bi-book-plus"></i>
        Adicionar Livro
      </a>
    </form>
  </div>

  <!-- Tabela -->
  <div class="overflow-x-auto bg-white shadow-lg rounded-xl border border-gray-200">
    <table class="min-w-full text-sm text-gray-700">
      <thead class="bg-gray-100 text-gray-800 uppercase text-xs">
        <tr>
          <th class="px-4 py-3 text-left"><i class="bi bi-book-fill mr-1"></i>Título</th>
          <th class="px-4 py-3 text-left"><i class="bi bi-person-fill mr-1"></i>Autor</th>
          <th class="px-4 py-3 text-left"><i class="bi bi-upc-scan mr-1"></i>ISBN</th>
          <th class="px-4 py-3 text-left"><i class="bi bi-tags-fill mr-1"></i>Categoria</th>
          <th class="px-4 py-3 text-left"><i class="bi bi-calendar3 mr-1"></i>Ano</th>
          <th class="px-4 py-3 text-left"><i class="bi bi-stack mr-1"></i>Disponível / Total</th>
          <th class="px-4 py-3 text-left"><i class="bi bi-gear-fill mr-1"></i>Ações</th>
        </tr>
      </thead>

      <tbody class="divide-y divide-gray-100">
        @foreach ($books as $book)
          @if ($book->is_active || auth()->user()?->admin)
            <tr class="hover:bg-gray-50 transition">
              <td class="px-4 py-3">{{ $book->title }}</td>
              <td class="px-4 py-3">{{ $book->authors->first()->full_name ?? 'Sem autor' }}</td>
              <td class="px-4 py-3">{{ $book->isbn }}</td>
              <td class="px-4 py-3">{{ $book->category->name ?? 'Sem categoria' }}</td>
              <td class="px-4 py-3">{{ $book->year }}</td>
              <td class="px-4 py-3">{{ $book->isAvailable() }} / {{ $book->quantity }}</td>

              <td class="px-4 py-3 space-x-1 whitespace-nowrap">
                <!-- Editar -->
                <a href="{{ route('books.show', $book->id) }}"
                   class="inline-flex items-center justify-center px-2 py-1 text-blue-600 hover:bg-blue-100 rounded-md transition"
                   title="Editar livro">
                  <i class="bi bi-pencil-square"></i>
                </a>

                @if (auth()->user()?->admin)
                  @if ($book->is_active)
                    <form action="{{ route('books.deactivate', $book->id) }}" method="POST" class="inline">
                      @csrf
                      @method('PUT')
                      <button type="submit" class="inline-flex items-center justify-center px-2 py-1 text-yellow-600 hover:bg-yellow-100 rounded-md transition" title="Inativar livro">
                        <i class="bi bi-slash-circle"></i>
                      </button>
                    </form>
                  @else
                    <form action="{{ route('books.activate', $book->id) }}" method="POST" class="inline">
                      @csrf
                      @method('PUT')
                      <button type="submit" class="inline-flex items-center justify-center px-2 py-1 text-green-600 hover:bg-green-100 rounded-md transition" title="Ativar livro">
                        <i class="bi bi-check-circle"></i>
                      </button>
                    </form>
                  @endif

                  <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza que deseja excluir este livro?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center justify-center px-2 py-1 text-red-600 hover:bg-red-100 rounded-md transition" title="Excluir livro">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                @endif
              </td>
            </tr>
          @endif
        @endforeach
      </tbody>
    </table>
  </div>

  <!-- Paginação -->
  <div class="mt-4 flex justify-center">
    {{ $books->links() }}
  </div>
</div>
@endsection
