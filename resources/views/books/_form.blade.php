@csrf

<div class="form-group">
    <label for="title">Judul</label>
    <input type="text" id="title" name="title" value="{{ old('title', $book->title) }}"
           class="field @error('title') invalid @enderror" maxlength="80" required autofocus
           @error('title') aria-invalid="true" aria-describedby="title-error" @enderror>
    @error('title') <p class="error" id="title-error">{{ $message }}</p> @enderror
</div>

<div class="form-group">
    <label for="author">Penulis</label>
    <input type="text" id="author" name="author" value="{{ old('author', $book->author) }}"
           class="field @error('author') invalid @enderror" maxlength="60" required
           @error('author') aria-invalid="true" aria-describedby="author-error" @enderror>
    @error('author') <p class="error" id="author-error">{{ $message }}</p> @enderror
</div>

<div class="form-row">
    <div class="form-group">
        <label for="category">Kategori</label>
        <select id="category" name="category" class="field @error('category') invalid @enderror" required
                @error('category') aria-invalid="true" aria-describedby="category-error" @enderror>
            @foreach ($categories as $c)
                <option value="{{ $c }}" @selected(old('category', $book->category) === $c)>{{ $c }}</option>
            @endforeach
        </select>
        @error('category') <p class="error" id="category-error">{{ $message }}</p> @enderror
    </div>

    <div class="form-group">
        <label for="year">Tahun terbit</label>
        <input type="number" id="year" name="year" value="{{ old('year', $book->year) }}"
               class="field @error('year') invalid @enderror" min="1000" max="2100" step="1" required
               @error('year') aria-invalid="true" aria-describedby="year-error" @enderror>
        @error('year') <p class="error" id="year-error">{{ $message }}</p> @enderror
    </div>
</div>

<div class="form-group">
    <label for="synopsis">Sinopsis singkat</label>
    <textarea id="synopsis" name="synopsis" rows="4" maxlength="240"
              class="field @error('synopsis') invalid @enderror"
              @error('synopsis') aria-invalid="true" aria-describedby="synopsis-error" @enderror>{{ old('synopsis', $book->synopsis) }}</textarea>
    <p class="hint">Opsional, maksimal 240 karakter.</p>
    @error('synopsis') <p class="error" id="synopsis-error">{{ $message }}</p> @enderror
</div>

<div class="form-group">
    <label for="cover">Gambar sampul</label>

    @if ($book->cover_url)
        <div class="current-cover">
            <img src="{{ $book->cover_url }}" alt="Sampul saat ini">
            <label class="check">
                <input type="checkbox" name="remove_cover" value="1"> Hapus gambar sampul
            </label>
        </div>
    @endif

    <input type="file" id="cover" name="cover" accept="image/png,image/jpeg,image/webp"
           class="field @error('cover') invalid @enderror"
           @error('cover') aria-invalid="true" aria-describedby="cover-error" @enderror>
    <p class="hint">Opsional. JPG, PNG, atau WEBP, maksimal 2 MB. Jika kosong, sampul memakai warna kategori.</p>
    @error('cover') <p class="error" id="cover-error">{{ $message }}</p> @enderror
</div>
