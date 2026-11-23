<div class="cover {{ $book->cover_url ? 'has-image' : '' }}" style="--cover: {{ $book->cover_color }}; --spine: {{ $book->cover_spine }};" aria-hidden="true">
    @if ($book->cover_url)
        <img src="{{ $book->cover_url }}" alt="" class="cover-img" loading="lazy">
    @else
        <p class="cover-title">{{ $book->title }}</p>
        <p class="cover-author">{{ $book->author }}</p>
    @endif
</div>
