<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Masukkan data dummy untuk UMKM dan Kategori
        DB::table('umkm_profiles')->insert([
            'store_name' => 'Toko Laris Manis',
            'description' => 'Menyediakan aneka produk kerajinan tangan lokal.',
            'location' => 'Bandung',
            'user_id' => 1 // Asumsi user dengan ID 1 sudah ada
        ]);

        DB::table('product_categories')->insert([
            ['name' => 'Fashion'],
            ['name' => 'Kuliner'],
            ['name' => 'Kerajinan'],
        ]);

        // Masukkan data dummy untuk Produk
        DB::table('products')->insert([
            [
                'umkm_id' => 1,
                'category_id' => 3, // ID untuk kategori Kerajinan
                'name' => 'Tas Anyaman Unik',
                'slug' => 'tas-anyaman-unik',
                'description' => 'Tas anyaman tangan dari bahan alami berkualitas tinggi.',
                'price' => 150000.00,
                'stock' => 20,
                'image_url' => 'products/tas-anyaman.jpg',
            ],
            [
                'umkm_id' => 1,
                'category_id' => 2, // ID untuk kategori Kuliner
                'name' => 'Kue Kering Cokelat',
                'slug' => 'kue-kering-cokelat',
                'description' => 'Kue kering dengan taburan cokelat lezat, cocok untuk camilan.',
                'price' => 55000.00,
                'stock' => 50,
                'image_url' => 'products/kue-cokelat.jpg',
            ],
            [
                'umkm_id' => 1,
                'category_id' => 1, // ID untuk kategori Fashion
                'name' => 'Batik Tulis Motif Bunga',
                'slug' => 'batik-tulis-motif-bunga',
                'description' => 'Kain batik tulis asli dengan motif bunga yang elegan.',
                'price' => 320000.00,
                'stock' => 10,
                'image_url' => 'products/batik-tulis.jpg',
            ],
        ]);
    }
}
