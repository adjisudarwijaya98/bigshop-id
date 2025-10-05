<?php

// database/migrations/*_create_orders_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Pembeli

            // Detail Pengiriman
            $table->string('receiver_name');
            $table->string('receiver_phone');
            $table->text('shipping_address');
            $table->string('shipping_city');
            $table->string('shipping_postal_code');

            // Detail Keuangan & Status
            $table->unsignedBigInteger('total_price'); // Total seluruh order
            $table->string('status')->default('pending_payment'); // pending_payment, processing, completed, cancelled
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
