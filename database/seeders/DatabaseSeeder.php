<?php

namespace Database\Seeders;

use App\Models\CourseCategory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class, // Jalankan ini terlebih dahulu
            CarouselSeeder::class,
            ProductSeeder::class,
            CourseCategorySeeder::class
        ]);
    }
}
