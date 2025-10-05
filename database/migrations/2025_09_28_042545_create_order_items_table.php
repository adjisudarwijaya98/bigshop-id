<?php

// database/migrations/*_create_order_items_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('umkm_id')->constrained('umkm_profiles')->onDelete('cascade'); // Penting untuk alokasi order ke vendor

            $table->string('product_name'); // Simpan nama saat dibeli (jika produk diubah/dihapus)
            $table->unsignedBigInteger('price'); // Simpan harga saat dibeli
            $table->unsignedInteger('quantity'); // Jumlah
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
