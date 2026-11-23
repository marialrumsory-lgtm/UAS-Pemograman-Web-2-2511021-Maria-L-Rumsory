@extends('layouts.app')

@section('title', 'Daftar buku')

@section('content')
    <form method="GET" action="{{ route('books.index') }}" class="controls" role="search">
        <nav class="chips" aria-label="Filter kategori">
            @foreach (['' => 'Semua'] + array_combine($categories, $categories) as $value => $label)
                <a href="{{ route('books.index', array_filter(['category' => $value, 'q' => $q, 'sort' => $sort])) }}"
                   class="chip {{ $category === (string) $value ? 'active' : '' }}"
                   @if ($category === (string) $value) aria-current="true" @endif>{{ $label }}</a>
            @endforeach
        </nav>

        <input type="hidden" name="category" value="{{ $category }}">

        <div class="search-row">
            <input type="search" name="q" value="{{ $q }}" class="field search"
                   placeholder="Cari judul atau penulis" aria-label="Cari judul atau penulis">
            <select name="sort" class="field sort" aria-label="Urutkan" onchange="this.form.submit()">
                @foreach ($sorts as $key => $s)
                    <option value="{{ $key }}" @selected($sort === $key)>{{ $s['label'] }}</option>
                @endforeach
            </select>

            <button type="submit" class="btn btn-primary">Cari</button>
        </div>
    </form>

    <p class="count">{{ $books->count() }} dari {{ $total }} buku</p>

    @if ($books->isEmpty())
        <div class="empty">
            <strong>Buku tidak ditemukan.</strong><br>
            Coba kata kunci lain atau pilih kategori yang berbeda.
        </div>
    @else
        <div class="grid">
            @foreach ($books as $book)
                <a href="{{ route('books.show', $book) }}" class="card"
                   aria-label="{{ $book->title }}, {{ $book->author }}">
                    @include('books._cover', ['book' => $book])
                    <p class="meta-title">{{ $book->title }}</p>
                    <p class="meta-author">{{ $book->author }}</p>
                    <p class="meta-info">{{ $book->category }} · {{ $book->year }}</p>
                </a>
            @endforeach
        </div>
    @endif
@endsection
