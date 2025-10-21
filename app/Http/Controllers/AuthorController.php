<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index(Request $request)
    {
        $query = Author::query();

        if ($search = $request->input('q')) {
            $query->where('full_name', 'like', "%{$search}%");
        }

        $authors = $query->orderBy('full_name')->paginate(10)->withQueryString();

        return view('authors.index', compact('authors'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show(Author $author)
    {
    }

    public function edit(Author $author)
    {
    }

    public function update(Request $request, Author $author)
    {
    }

    public function active(Author $author)
    {
    }

    public function deactivate(Author $author)
    {
    }

    public function destroy(Author $author)
    {
    }
}
