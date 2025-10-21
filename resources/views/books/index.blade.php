@extends('layouts.authenticated')

@section('title', 'GenBook')

@section('content')
  <div class="max-w-7xl mx-auto px-4 py-10">
    <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6">
      <h2 class="text-2xl font-bold text-gray-800 text-center md:text-left flex items-center gap-2">
        <i data-lucide="book-open-text" class="w-6 h-6 text-blue-600"></i>
        Livros
      </h2>

      <form action="{{ route('books.index') }}" method="GET"
        class="flex flex-wrap items-stretch gap-3 justify-center md:justify-end w-full md:w-auto">
        <div
          class="flex items-center bg-white border border-gray-300 rounded-lg shadow-sm overflow-hidden w-full md:w-72">
          <span class="px-3 text-gray-500">
            <i data-lucide="search" class="w-5 h-5"></i>
          </span>
          <input type="text" name="q" value="{{ request('q') }}" class="w-full px-3 py-2 text-gray-700 focus:outline-none"
            placeholder="Buscar livros...">
        </div>

        <button type="submit"
          class="flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition">
          <i data-lucide="search" class="w-4 h-4"></i>
          Buscar
        </button>

        <a href="{{ route('books.new') }}"
          class="flex items-center gap-2 bg-yellow-500 text-white px-4 py-2 rounded-lg shadow hover:bg-yellow-600 transition">
          <i data-lucide="plus-circle" class="w-4 h-4"></i>
          Adicionar Livro
        </a>
      </form>
    </div>

    <div class="overflow-x-auto bg-white shadow-lg rounded-xl border border-gray-200">
      <table class="min-w-full text-sm text-gray-700">
        <thead class="bg-gray-100 text-gray-800 uppercase text-xs">
          <tr>
            <th class="px-4 py-3 text-left"><i data-lucide="book" class="inline w-4 h-4 mr-1"></i>Título</th>
            <th class="px-4 py-3 text-left"><i data-lucide="user" class="inline w-4 h-4 mr-1"></i>Autor</th>
            <th class="px-4 py-3 text-left"><i data-lucide="barcode" class="inline w-4 h-4 mr-1"></i>ISBN</th>
            <th class="px-4 py-3 text-left"><i data-lucide="tags" class="inline w-4 h-4 mr-1"></i>Categoria</th>
            <th class="px-4 py-3 text-left"><i data-lucide="calendar" class="inline w-4 h-4 mr-1"></i>Ano</th>
            <th class="px-4 py-3 text-left"><i data-lucide="layers" class="inline w-4 h-4 mr-1"></i>Disp. / Total</th>
            <th class="px-4 py-3 text-left"><i data-lucide="settings" class="inline w-4 h-4 mr-1"></i>Ações</th>
          </tr>
        </thead>

        <tbody class="divide-y divide-gray-100">
          @foreach ($books as $book)
            @if ($book->is_active || auth()->user()?->admin)
              <tr class="hover:bg-gray-50 transition">
                <td class="px-4 py-3 font-medium text-gray-800">{{ $book->title }}</td>
                <td class="px-4 py-3">
                  {{ $book->authors->pluck('full_name')->join(', ') ?: 'Sem autor' }}
                </td>
                <td class="px-4 py-3">{{ $book->isbn ?: '—' }}</td>
                <td class="px-4 py-3">{{ $book->category->name ?? 'Sem categoria' }}</td>
                <td class="px-4 py-3">{{ $book->year ?: '—' }}</td>
                <td class="px-4 py-3">{{ $book->isAvailable() }} / {{ $book->quantity }}</td>

                <td class="px-4 py-3 space-x-1 whitespace-nowrap flex items-center">
                  <a href="{{ route('books.show', $book->id) }}"
                    class="inline-flex items-center justify-center p-2 text-blue-600 hover:bg-blue-100 rounded-md transition"
                    title="Editar livro">
                    <i data-lucide="pencil-line" class="w-4 h-4"></i>
                  </a>

                  @if (auth()->user()?->admin)
                    @if ($book->is_active)
                      <form action="{{ route('books.deactivate', $book->id) }}" method="POST" class="inline">
                        @csrf
                        @method('PUT')
                        <button type="submit"
                          class="inline-flex items-center justify-center p-2 text-yellow-600 hover:bg-yellow-100 rounded-md transition"
                          title="Inativar livro">
                          <i data-lucide="slash" class="w-4 h-4"></i>
                        </button>
                      </form>
                    @else
                      <form action="{{ route('books.activate', $book->id) }}" method="POST" class="inline">
                        @csrf
                        @method('PUT')
                        <button type="submit"
                          class="inline-flex items-center justify-center p-2 text-green-600 hover:bg-green-100 rounded-md transition"
                          title="Ativar livro">
                          <i data-lucide="check-circle-2" class="w-4 h-4"></i>
                        </button>
                      </form>
                    @endif

                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="inline"
                      onsubmit="return confirm('Tem certeza que deseja excluir este livro?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit"
                        class="inline-flex items-center justify-center p-2 text-red-600 hover:bg-red-100 rounded-md transition"
                        title="Excluir livro">
                        <i data-lucide="trash-2" class="w-4 h-4"></i>
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

    <div class="mt-6 flex justify-center">
      {{ $books->links() }}
    </div>
  </div>

@endsection