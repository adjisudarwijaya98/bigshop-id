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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();

            // Relasi ke Kursus (Course)
            $table->foreignId('course_id')
                ->constrained('courses') // Menghubungkan ke tabel courses
                ->onDelete('cascade'); // Hapus pelajaran jika kursusnya dihapus

            $table->string('title');
            $table->string('video_url'); // URL video materi (Wajib)
            $table->text('content')->nullable(); // Deskripsi atau teks pendukung materi
            $table->string('image_url')->nullable(); // Path gambar pendukung materi (Sesuai permintaan Anda)

            $table->unsignedSmallInteger('order'); // Urutan pelajaran di dalam kursus (1, 2, 3, dst.)
            $table->boolean('is_published')->default(false); // Status tayang pelajaran

            $table->timestamps();

            // Memastikan urutan pelajaran unik hanya di dalam satu kursus
            $table->unique(['course_id', 'order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
