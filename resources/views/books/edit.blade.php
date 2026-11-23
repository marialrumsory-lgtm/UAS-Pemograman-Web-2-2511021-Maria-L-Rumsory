@extends('layouts.app')

@section('content')
<div class="wrap" style="max-width: 700px; margin: 2rem auto;">
    <!-- Header Form & Tombol Kembali -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h1 style="font-size: 1.8rem; font-weight: 700; margin: 0; color: var(--text);">Ubah Data Buku</h1>
        <a href="{{ route('books.index') }}" class="btn">&larr; Batal</a>
    </div>

    <!-- Kotak / Wadah Form Utama -->
    <div style="background: var(--surface); border: 1px solid var(--border); border-radius: 16px; padding: 2rem; box-shadow: var(--shadow);">
        
        <!-- Pesan Error Validasi (jika ada) -->
        @if ($errors->any())
            <div style="margin-bottom: 1.25rem; padding: 1rem; border-radius: 10px; background: var(--danger-bg); color: var(--danger); font-weight: 500;">
                <ul style="margin: 0; padding-left: 1.2rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 1.25rem;">
            @csrf
            @method('PUT')

            <!-- Judul -->
            <div>
                <label for="title" style="display: block; font-weight: 600; margin-bottom: 0.4rem;">Judul Buku</label>
                <input type="text" id="title" name="title" value="{{ old('title', $book->title) }}" class="field" required>
            </div>

            <!-- Penulis -->
            <div>
                <label for="author" style="display: block; font-weight: 600; margin-bottom: 0.4rem;">Penulis</label>
                <input type="text" id="author" name="author" value="{{ old('author', $book->author) }}" class="field" required>
            </div>

            <!-- Kategori & Tahun Terbit (Grid 2 Kolom) -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div>
                    <label for="category" style="display: block; font-weight: 600; margin-bottom: 0.4rem;">Kategori</label>
                    <select id="category" name="category" class="field">
                        <option value="Novel" {{ (old('category', $book->category ?? '') == 'Novel') ? 'selected' : '' }}>Novel</option>
                        <option value="Pengembangan Diri" {{ (old('category', $book->category ?? '') == 'Pengembangan Diri') ? 'selected' : '' }}>Pengembangan Diri</option>
                        <option value="Teknologi" {{ (old('category', $book->category ?? '') == 'Teknologi') ? 'selected' : '' }}>Teknologi</option>
                        <option value="Sejarah" {{ (old('category', $book->category ?? '') == 'Sejarah') ? 'selected' : '' }}>Sejarah</option>
                    </select>
                </div>
                <div>
                    <label for="year" style="display: block; font-weight: 600; margin-bottom: 0.4rem;">Tahun Terbit</label>
                    <input type="number" id="year" name="year" value="{{ old('year', $book->year) }}" class="field" required>
                </div>
            </div>

            <!-- Sinopsis -->
            <div>
                <label for="description" style="display: block; font-weight: 600; margin-bottom: 0.4rem;">Sinopsis / Deskripsi</label>
                <textarea id="description" name="description" rows="4" class="field" style="resize: vertical;">{{ old('description', $book->description) }}</textarea>
                <small style="color: var(--muted); display: block; margin-top: 0.3rem;">Opsional, maksimal 240 karakter atau lebih.</small>
            </div>

            <!-- Gambar Sampul Saat Ini & Input File Baru -->
            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 0.4rem;">Gambar Sampul</label>
                @if(!empty($book->cover_image))
                    <div style="margin-bottom: 0.75rem;">
                        <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Sampul saat ini" style="height: 100px; border-radius: 8px; border: 1px solid var(--border);">
                        <span style="display: block; font-size: 0.85rem; color: var(--muted); margin-top: 0.2rem;">Sampul saat ini</span>
                    </div>
                @endif
                <input type="file" name="cover_image" class="field" style="padding: 0.4rem;">
            </div>

            <!-- Tombol Aksi Simpan -->
            <div style="display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 1rem;">
                <a href="{{ route('books.index') }}" class="btn">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection