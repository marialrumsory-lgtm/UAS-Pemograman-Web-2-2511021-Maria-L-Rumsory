@extends('layouts.app')

@section('content')
<div style="display: flex; justify-content: center; align-items: center; min-height: 70vh; padding: 1.5rem 0;">
    <div style="width: 100%; max-width: 440px; background: var(--surface); padding: 2.5rem; border-radius: 16px; border: 1px solid var(--border); box-shadow: var(--shadow);">
        
        <!-- Judul & Keterangan -->
        <div style="text-align: center; margin-bottom: 2rem;">
            <h2 style="font-size: 1.75rem; font-weight: 700; margin: 0 0 0.5rem; color: var(--text);">Selamat Datang</h2>
            <p style="color: var(--muted); margin: 0; font-size: 0.95rem;">Masuk ke akun Rak Digital Anda</p>
        </div>

        <!-- Pesan Error (jika ada) -->
        @if ($errors->any())
            <div style="margin-bottom: 1.25rem; padding: 0.85rem 1rem; border-radius: 10px; background: #fef2f2; color: #b3261e; font-size: 0.9rem;">
                <ul style="margin: 0; padding-left: 1.2rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" style="display: flex; flex-direction: column; gap: 1.25rem;">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" style="display: block; font-weight: 600; margin-bottom: 0.4rem; font-size: 0.9rem;">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" class="field" required autofocus autocomplete="username" placeholder="nama@email.com">
            </div>

            <!-- Kata Sandi -->
            <div>
                <label for="password" style="display: block; font-weight: 600; margin-bottom: 0.4rem; font-size: 0.9rem;">Kata Sandi</label>
                <input id="password" type="password" name="password" class="field" required autocomplete="current-password" placeholder="Masukkan kata sandi">
            </div>

            <!-- Ingat Saya -->
            <div style="display: flex; align-items: center; justify-content: space-between; font-size: 0.9rem;">
                <label style="display: flex; align-items: center; gap: 0.5rem; color: var(--muted); cursor: pointer;">
                    <input type="checkbox" name="remember" style="accent-color: var(--accent);"> Ingat saya
                </label>
            </div>

            <!-- Tombol Masuk -->
            <div style="margin-top: 0.5rem;">
                <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center;">Masuk</button>
            </div>

            <!-- Tautan ke Halaman Register -->
            <div style="text-align: center; margin-top: 1rem; font-size: 0.9rem; color: var(--muted);">
                Belum punya akun? <a href="{{ route('register') }}" style="color: var(--accent); font-weight: 600; text-decoration: none;">Daftar di sini</a>
            </div>
        </form>
    </div>
</div>
@endsection