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
        Schema::create('course_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique(); // Nama kategori (Misal: Digital Marketing UMKM)
            $table->string('slug', 100)->unique(); // Slug untuk URL (Misal: digital-marketing-umkm)
            $table->string('image_url')->nullable(); // Path untuk ikon atau thumbnail kategori
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_categories');
    }
};
