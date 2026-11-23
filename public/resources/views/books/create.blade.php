@extends('layouts.app')

@section('title', 'Tambah buku')

@section('content')
    <div class="panel form-panel">
        <h1 class="page-title">Tambah buku</h1>
        <form method="POST" action="{{ route('books.store') }}" novalidate>
            @include('books._form')
            <div class="form-actions">
                <a href="{{ route('books.index') }}" class="btn">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan buku</button>
            </div>
        </form>
    </div>
@endsection
