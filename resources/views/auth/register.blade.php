@extends('layouts.app')

@section('content')
<div style="display: flex; justify-content: center; align-items: center; min-height: 70vh; padding: 1.5rem 0;">
    <div style="width: 100%; max-width: 440px; background: var(--surface); padding: 2.5rem; border-radius: 16px; border: 1px solid var(--border); box-shadow: var(--shadow);">
        
        <!-- Judul & Keterangan -->
        <div style="text-align: center; margin-bottom: 2rem;">
            <h2 style="font-size: 1.75rem; font-weight: 700; margin: 0 0 0.5rem; color: var(--text);">Buat Akun Baru</h2>
            <p style="color: var(--muted); margin: 0; font-size: 0.95rem;">Daftar untuk mengelola Rak Digital Anda</p>
        </div>

        <!-- Pesan Error Validasi (jika ada) -->
        @if ($errors->any())
            <div style="margin-bottom: 1.25rem; padding: 0.85rem 1rem; border-radius: 10px; background: #fef2f2; color: #b3261e; font-size: 0.9rem;">
                <ul style="margin: 0; padding-left: 1.2rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" style="display: flex; flex-direction: column; gap: 1.25rem;">
            @csrf

            <!-- Nama -->
            <div>
                <label for="name" style="display: block; font-weight: 600; margin-bottom: 0.4rem; font-size: 0.9rem;">Nama Lengkap</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" class="field" required autofocus autocomplete="name" placeholder="Masukkan nama Anda">
            </div>

            <!-- Email Address -->
            <div>
                <label for="email" style="display: block; font-weight: 600; margin-bottom: 0.4rem; font-size: 0.9rem;">Alamat Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" class="field" required autocomplete="username" placeholder="nama@email.com">
            </div>

            <!-- Password -->
            <div>
                <label for="password" style="display: block; font-weight: 600; margin-bottom: 0.4rem; font-size: 0.9rem;">Kata Sandi</label>
                <input id="password" type="password" name="password" class="field" required autocomplete="new-password" placeholder="Minimal 8 karakter">
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" style="display: block; font-weight: 600; margin-bottom: 0.4rem; font-size: 0.9rem;">Konfirmasi Kata Sandi</label>
                <input id="password_confirmation" type="password" name="password_confirmation" class="field" required autocomplete="new-password" placeholder="Ulangi kata sandi">
            </div>

            <!-- Tombol Aksi & Link Login -->
            <div style="margin-top: 0.5rem;">
                <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center;">Daftar Sekarang</button>
            </div>

            <div style="text-align: center; margin-top: 1rem; font-size: 0.9rem; color: var(--muted);">
                Sudah punya akun? <a href="{{ route('login') }}" style="color: var(--accent); font-weight: 600; text-decoration: none;">Masuk di sini</a>
            </div>
        </form>
    </div>
</div>
@endsection