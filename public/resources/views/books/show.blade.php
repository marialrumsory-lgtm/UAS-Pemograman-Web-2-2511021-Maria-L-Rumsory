@extends('layouts.app')

@section('title', $book->title)

@section('content')
    <article class="panel detail" style="--cover: {{ $book->cover_color }};">
        @include('books._cover', ['book' => $book])

        <div>
            <h1>{{ $book->title }}</h1>
            <p class="sub">{{ $book->author }} · {{ $book->year }} · <span class="badge">{{ $book->category }}</span></p>

            @if ($book->synopsis)
                <p>{{ $book->synopsis }}</p>
            @else
                <p class="hint">Belum ada sinopsis.</p>
            @endif

            <div class="actions">
                <a href="{{ route('books.index') }}" class="btn">Kembali</a>
                <a href="{{ route('books.edit', $book) }}" class="btn">Ubah data</a>
                <form method="POST" action="{{ route('books.destroy', $book) }}"
                      onsubmit="return confirm('Hapus buku &quot;{{ addslashes($book->title) }}&quot;? Tindakan ini tidak dapat dibatalkan.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus buku</button>
                </form>
            </div>
        </div>
    </article>
@endsection
