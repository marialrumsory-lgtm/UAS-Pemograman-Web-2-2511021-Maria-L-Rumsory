<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public const CATEGORIES = ['Novel', 'Pengembangan Diri', 'Teknologi', 'Sejarah'];

    // Warna sampul per kategori: [warna sampul, warna punggung buku]
    public const COVER_COLORS = [
        'Novel'             => ['#7b2d3b', '#5c1f2b'], // merah marun
        'Pengembangan Diri' => ['#1d6b5a', '#14503f'], // hijau
        'Teknologi'         => ['#25456e', '#1a3250'], // biru tua
        'Sejarah'           => ['#6b4e1f', '#4d3715'], // cokelat
    ];

    public const SORTS = [
        'judul'   => ['label' => 'Judul A–Z',     'column' => 'title',  'direction' => 'asc'],
        'penulis' => ['label' => 'Penulis A–Z',   'column' => 'author', 'direction' => 'asc'],
        'terbaru' => ['label' => 'Tahun terbaru', 'column' => 'year',   'direction' => 'desc'],
        'terlama' => ['label' => 'Tahun terlama', 'column' => 'year',   'direction' => 'asc'],
    ];

    protected $fillable = ['title', 'author', 'category', 'year', 'synopsis', 'cover'];

    public function getCoverColorAttribute(): string
    {
        return self::COVER_COLORS[$this->category][0] ?? '#444444';
    }

    public function getCoverUrlAttribute(): ?string
    {
        return $this->cover ? asset($this->cover) : null;
    }

    public function getCoverSpineAttribute(): string
    {
        return self::COVER_COLORS[$this->category][1] ?? '#222222';
    }
}
