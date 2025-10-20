<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Mostrar lista de livros
     */
  public function index(Request $request)
{
    $query = Book::with(['authors', 'category']);

    if ($search = $request->input('q')) {
        $query->where('title', 'like', "%{$search}%")
              ->orWhereHas('authors', fn($q) => $q->where('full_name', 'like', "%{$search}%"));
    }

    $books = $query->orderBy('title')->paginate(10)->withQueryString();

    return view('books.index', compact('books'));
}


    /**
     * Exibir formulário de criação
     */
    public function create()
    {
        $authors = Author::all();
        $categories = Category::all();

        return view('books.create', compact('authors', 'categories'));
    }

    /**
     * Salvar novo livro
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'category_id'   => 'nullable|exists:categories,id',
            'publisher'     => 'nullable|string|max:255',
            'isbn'          => 'required|string|unique:books,isbn',
            'edition'       => 'required|string|max:255',
            'year'          => 'required|integer|min:0',
            'quantity'      => 'required|integer|min:1',
            'shelf_location'=> 'nullable|string|max:255',
            'cover_name'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'authors'       => 'array',
            'authors.*'     => 'exists:authors,id',
        ]);

        $book = Book::create($validated);

        if ($request->hasFile('cover_name')) {
            $path = $request->file('cover_name')->store('covers', 'public');
            $book->update(['cover_name' => $path]);
        }

        if (!empty($validated['authors'])) {
            $book->authors()->sync($validated['authors']);
        }

        return redirect()->route('books.index')->with('success', 'Livro criado com sucesso!');
    }

    /**
     * Mostrar detalhes de um livro
     */
    public function show(Book $book)
    {
        $book->load(['authors', 'category']);
        return view('books.show', compact('book'));
    }

    /**
     * Exibir formulário de edição
     */
    public function edit(Book $book)
    {
        $authors = Author::all();
        $categories = Category::all();

        return view('books.edit', compact('book', 'authors', 'categories'));
    }

    /**
     * Atualizar livro
     */
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'category_id'   => 'nullable|exists:categories,id',
            'publisher'     => 'nullable|string|max:255',
            'isbn'          => 'required|string|unique:books,isbn,' . $book->id,
            'edition'       => 'required|string|max:255',
            'year'          => 'required|integer|min:0',
            'quantity'      => 'required|integer|min:1',
            'shelf_location'=> 'nullable|string|max:255',
            'cover_name'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'authors'       => 'array',
            'authors.*'     => 'exists:authors,id',
        ]);

        $book->update($validated);

        if ($request->hasFile('cover_name')) {
            if ($book->cover_name) {
                Storage::disk('public')->delete($book->cover_name);
            }
            $path = $request->file('cover_name')->store('covers', 'public');
            $book->update(['cover_name' => $path]);
        }

        if (!empty($validated['authors'])) {
            $book->authors()->sync($validated['authors']);
        }

        return redirect()->route('books.index')->with('success', 'Livro atualizado com sucesso!');
    }

    /**
     * Desativar livro (soft delete customizado)
     */
    public function deactivate(Book $book)
    {
        $book->update(['is_active' => false]);
        return redirect()->route('books.index')->with('success', 'Livro inativado com sucesso!');
    }

    /**
     * Ativar livro novamente
     */
    public function activate(Book $book)
    {
        if (!$book->authors()->exists()) {
            return back()->with('error', 'Livro não pode ser ativado sem autores.');
        }

        $book->update(['is_active' => true]);
        return redirect()->route('books.index')->with('success', 'Livro ativado com sucesso!');
    }

    /**
     * Excluir livro
     */
    public function destroy(Book $book)
    {
        if ($book->cover_name) {
            Storage::disk('public')->delete($book->cover_name);
        }

        $book->delete();

        return redirect()->route('books.index')->with('success', 'Livro excluído com sucesso!');
    }
}
