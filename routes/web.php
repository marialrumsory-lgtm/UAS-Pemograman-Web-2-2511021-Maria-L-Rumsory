<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Halaman utama langsung diarahkan ke buku (atau ubah ke 'welcome' jika ingin halaman depan dulu)
Route::redirect('/', '/books');

// Rute untuk Buku (Dilindungi middleware 'auth' agar wajib login)
Route::resource('books', BookController::class)->middleware(['auth']);

// Rute Bawaan Profil Pengguna (Laravel Breeze / Default)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Memuat rute autentikasi bawaan (login, register, logout, dll)
require __DIR__.'/auth.php';