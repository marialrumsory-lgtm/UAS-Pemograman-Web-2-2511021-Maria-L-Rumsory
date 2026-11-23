@extends('layouts.app')

@section('content')
<div class="wrap" style="max-width: 800px; margin: 2rem auto;">
    <!-- Navigasi Kembali & Tombol Aksi (Edit & Hapus) -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <a href="{{ route('books.index') }}" class="btn">&larr; Kembali</a>
        
        @auth
        <div style="display: flex; gap: 0.75rem;">
            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-primary">Edit Buku</a>
            
            <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="margin: 0;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
        </div>
        @endauth
    </div>

    <!-- Kotak Utama Detail Buku -->
    <div style="background: var(--surface); border: 1px solid var(--border); border-radius: 16px; overflow: hidden; box-shadow: var(--shadow);">
        
        <!-- Area Sampul Buku yang Proporsional dan Rapi -->
        <div style="background: #14231d; max-height: 380px; display: flex; justify-content: center; align-items: center; overflow: hidden; position: relative;">
            @if(!empty($book->cover_image))
                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" style="width: 100%; height: 380px; object-fit: contain; padding: 1rem;">
            @else
                <div style="padding: 4rem 2rem; color: #fff; text-align: center;">
                    <h2 style="font-size: 1.8rem; margin: 0;">{{ $book->title }}</h2>
                    <p style="margin: 0.5rem 0 0; opacity: 0.85;">{{ $book->author }}</p>
                </div>
            @endif
        </div>

        <!-- Informasi Detail Buku -->
        <div style="padding: 2rem;">
            <h1 style="margin-top: 0; font-size: 1.8rem; color: var(--text); line-height: 1.3;">{{ $book->title }}</h1>
            
            <p style="color: var(--muted); font-size: 1.05rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap;">
                <strong style="color: var(--text);">{{ $book->author }}</strong> 
                <span>&bull;</span> 
                <span>{{ $book->year }}</span> 
                <span>&bull;</span> 
                <span style="background: var(--field); padding: 0.2rem 0.7rem; border-radius: 6px; font-weight: 500; font-size: 0.9rem;">{{ $book->category ?? 'Umum' }}</span>
            </p>

            <hr style="border: none; border-top: 1px solid var(--border); margin: 1.5rem 0;">

            <h3 style="font-size: 1.1rem; margin-bottom: 0.75rem; color: var(--text);">Sinopsis / Deskripsi</h3>
            <p style="line-height: 1.7; color: var(--text); white-space: pre-line; margin: 0;">
                {{ $book->description ?? 'Tidak ada sinopsis atau deskripsi untuk buku ini.' }}
            </p>
        </div>
    </div>
</div>
@endsection