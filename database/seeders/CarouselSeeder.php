<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarouselSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('carousels')->insert([
            [
                'title' => 'Jelajahi Ribuan Produk UMKM Lokal Terbaik',
                'subtitle' => 'Temukan kerajinan tangan, kuliner, dan fashion unik dari seluruh Indonesia.',
                'image_url' => 'images/carousel-market.jpg',
                'button_text' => 'Belanja Sekarang',
                'button_link' => '#',
            ],
            [
                'title' => 'Tingkatkan Skill Digitalmu',
                'subtitle' => 'Belajar pemasaran digital dan strategi bisnis langsung dari ahlinya.',
                'image_url' => 'images/carousel-learning.jpg',
                'button_text' => 'Mulai Belajar',
                'button_link' => '#',
            ],
            [
                'title' => 'Dukung Ekonomi Lokal, Berdampak Nyata!',
                'subtitle' => 'Setiap pembelian Anda membantu UMKM untuk berkembang.',
                'image_url' => 'images/carousel-impact.jpg',
                'button_text' => 'Pelajari Lebih Lanjut',
                'button_link' => '#',
            ],
        ]);
    }
}
