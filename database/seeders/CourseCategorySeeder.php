<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CourseCategory;
use Illuminate\Support\Str;

class CourseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoriesData = [
            [
                'name' => 'WhatsApp Bisnis UMKM',
                'image_path' => 'categories/whatsapp-bisnis.png', // Ganti dengan path gambar Anda
            ],
            [
                'name' => 'Digital Marketing UMKM',
                'image_path' => 'categories/digital-marketing.png',
            ],
            [
                'name' => 'Laporan Keuangan UMKM',
                'image_path' => 'categories/laporan-keuangan.png',
            ],
            [
                'name' => 'Manajemen Sosmed UMKM',
                'image_path' => 'categories/sosmed.png',
            ],
            [
                'name' => 'Legalitas Usaha UMKM',
                'image_path' => 'categories/legalitas.png',
            ],
            [
                'name' => 'Website Praktis UMKM',
                'image_path' => 'categories/website-praktis.png',
            ],
            [
                'name' => 'Teknik Live UMKM',
                'image_path' => 'categories/teknik-live.png',
            ],
            [
                'name' => 'Design Grafis UMKM',
                'image_path' => 'categories/design-grafis.png',
            ],
            [
                'name' => 'Media Iklan UMKM',
                'image_path' => 'categories/media-iklan.png',
            ],
            [
                'name' => 'Affiliate Marketing UMKM',
                'image_path' => 'categories/affiliate-marketing.png',
            ],
        ];

        foreach ($categoriesData as $data) {
            CourseCategory::create([
                'name' => $data['name'],
                'slug' => Str::slug($data['name']),
                // Simpan path yang relatif ke storage disk 'public'
                'image_url' => $data['image_path'],
            ]);
        }
    }
}
