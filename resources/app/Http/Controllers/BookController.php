<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
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
        $book = Book::create($this->payload($request));

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
        $book->update($this->payload($request, $book));

        return redirect()->route('books.show', $book)
            ->with('success', 'Data buku berhasil diperbarui.');
    }

    public function destroy(Book $book)
    {
        $title = $book->title;
        $this->deleteCover($book->cover);
        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Buku "' . $title . '" berhasil dihapus.');
    }

    /**
     * Data siap simpan: hasil validasi + penanganan gambar sampul.
     * Gambar disimpan langsung di public/covers (tanpa storage:link).
     */
    private function payload(Request $request, ?Book $book = null): array
    {
        $data = $this->validated($request);
        unset($data['cover'], $data['remove_cover']);

        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $name = Str::uuid() . '.' . $file->extension();
            $file->move(public_path('covers'), $name);

            if ($book) {
                $this->deleteCover($book->cover);
            }
            $data['cover'] = 'covers/' . $name;
        } elseif ($book && $request->boolean('remove_cover')) {
            $this->deleteCover($book->cover);
            $data['cover'] = null;
        }

        return $data;
    }

    private function deleteCover(?string $path): void
    {
        if ($path && File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'title'    => ['required', 'string', 'max:80'],
            'author'   => ['required', 'string', 'max:60'],
            'category' => ['required', Rule::in(Book::CATEGORIES)],
            'year'     => ['required', 'integer', 'between:1000,2100'],
            'synopsis' => ['nullable', 'string', 'max:240'],
            'cover'    => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'remove_cover' => ['nullable', 'boolean'],
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
            'cover.image'       => 'Berkas sampul harus berupa gambar.',
            'cover.mimes'       => 'Gambar sampul harus berformat JPG, PNG, atau WEBP.',
            'cover.max'         => 'Ukuran gambar sampul maksimal 2 MB.',
            'cover.uploaded'    => 'Gambar gagal diunggah. Pastikan ukurannya tidak lebih dari 2 MB.',
        ]);
    }
}
