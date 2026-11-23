<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            ['Atomic Habits',   'James Clear',            'Pengembangan Diri', 2018, 'Cara membangun kebiasaan baik lewat perubahan kecil yang konsisten.'],
            ['Bumi Manusia',    'Pramoedya Ananta Toer',  'Sejarah',           1980, 'Kisah Minke di masa kolonial Hindia Belanda, tentang cinta, keadilan, dan kebangkitan bangsa.'],
            ['Clean Code',      'Robert C. Martin',       'Teknologi',         2008, 'Panduan menulis kode yang bersih, mudah dibaca, dan mudah dirawat.'],
            ['Filosofi Teras',  'Henry Manampiring',      'Pengembangan Diri', 2018, 'Pengenalan filsafat Stoa untuk menghadapi emosi negatif dan hidup lebih tenang.'],
            ['Laskar Pelangi',  'Andrea Hirata',          'Novel',             2005, 'Perjuangan sepuluh anak Belitung untuk tetap bersekolah dengan segala keterbatasan.'],
            ['Laut Bercerita',  'Leila S. Chudori',       'Novel',             2017, 'Cerita para aktivis mahasiswa yang hilang pada akhir masa Orde Baru.'],
            ['Pulang',          'Tere Liye',              'Novel',             2015, 'Perjalanan Bujang, anak dari kampung, menjadi bagian dunia gelap yang penuh pertarungan.'],
            ['Sapiens',         'Yuval Noah Harari',      'Sejarah',           2011, 'Sejarah singkat umat manusia, dari zaman batu hingga era modern.'],
        ];

        foreach ($books as [$title, $author, $category, $year, $synopsis]) {
            Book::updateOrCreate(
                ['title' => $title, 'author' => $author],
                ['category' => $category, 'year' => $year, 'synopsis' => $synopsis]
            );
        }
    }
}
