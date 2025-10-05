<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();

            // Relasi ke CourseCategory
            // Pastikan tabel 'course_categories' dibuat sebelum migrasi ini
            $table->foreignId('category_id')
                ->constrained('course_categories') // Menghubungkan ke tabel course_categories
                ->onDelete('cascade'); // Hapus kursus jika kategorinya dihapus

            // Relasi ke User (Admin yang membuat kursus)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            $table->string('title');
            $table->text('description');
            $table->string('thumbnail')->nullable(); // Path gambar cover kursus
            $table->decimal('price', 10, 2)->default(0); // Harga, 0 jika gratis
            $table->boolean('is_published')->default(false); // Status tayang

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
