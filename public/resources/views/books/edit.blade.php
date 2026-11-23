@extends('layouts.app')

@section('title', 'Ubah ' . $book->title)

@section('content')
    <div class="panel form-panel">
        <h1 class="page-title">Ubah data buku</h1>
        <form method="POST" action="{{ route('books.update', $book) }}" novalidate>
            @method('PUT')
            @include('books._form')
            <div class="form-actions">
                <a href="{{ route('books.show', $book) }}" class="btn">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan perubahan</button>
            </div>
        </form>
    </div>
@endsection
