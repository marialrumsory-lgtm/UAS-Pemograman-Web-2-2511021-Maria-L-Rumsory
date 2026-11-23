<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $q        = trim((string) $request->query('q', ''));
        $category = (string) $request->query('category', '');
        $sort     = (string) $request->query('sort', 'judul');

        if (!in_array($category, Book::CATEGORIES, true)) {
            $category = '';
        }
        if (!array_key_exists($sort, Book::SORTS)) {
            $sort = 'judul';
        }

        $query = Book::query();

        if ($q !== '') {
            $like = '%' . addcslashes($q, '%_\\') . '%';
            $query->where(function ($w) use ($like) {
                $w->where('title', 'like', $like)
                  ->orWhere('author', 'like', $like);
            });
        }

        if ($category !== '') {
            $query->where('category', $category);
        }

        $order = Book::SORTS[$sort];
        $books = $query->orderBy($order['column'], $order['direction'])
                       ->orderBy('title')
                       ->get();

        return view('books.index', [
            'books'      => $books,
            'total'      => Book::count(),
            'q'          => $q,
            'category'   => $category,
            'sort'       => $sort,
            'categories' => Book::CATEGORIES,
            'sorts'      => Book::SORTS,
        ]);
    }

    public function create()
    {
        return view('books.create', [
            'book'       => new Book(['category' => Book::CATEGORIES[0]]),
            'categories' => Book::CATEGORIES,
        ]);
    }

    public function store(Request $request)
    {
        $book = Book::create($this->validated($request));

        return redirect()->route('books.index')
            ->with('success', 'Buku "' . $book->title . '" berhasil ditambahkan.');
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        return view('books.edit', [
            'book'       => $book,
            'categories' => Book::CATEGORIES,
        ]);
    }

    public function update(Request $request, Book $book)
    {
        $book->update($this->validated($request));

        return redirect()->route('books.show', $book)
            ->with('success', 'Data buku berhasil diperbarui.');
    }

    public function destroy(Book $book)
    {
        $title = $book->title;
        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Buku "' . $title . '" berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'title'    => ['required', 'string', 'max:80'],
            'author'   => ['required', 'string', 'max:60'],
            'category' => ['required', Rule::in(Book::CATEGORIES)],
            'year'     => ['required', 'integer', 'between:1000,2100'],
            'synopsis' => ['nullable', 'string', 'max:240'],
        ], [
            'title.required'    => 'Judul wajib diisi.',
            'title.max'         => 'Judul maksimal 80 karakter.',
            'author.required'   => 'Penulis wajib diisi.',
            'author.max'        => 'Penulis maksimal 60 karakter.',
            'category.required' => 'Kategori wajib dipilih.',
            'category.in'       => 'Kategori harus salah satu dari pilihan yang tersedia.',
            'year.required'     => 'Tahun terbit wajib diisi.',
            'year.integer'      => 'Tahun terbit harus berupa bilangan bulat.',
            'year.between'      => 'Tahun terbit harus antara 1000 dan 2100.',
            'synopsis.max'      => 'Sinopsis maksimal 240 karakter.',
        ]);
    }
}
