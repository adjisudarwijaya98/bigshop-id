<?php

namespace App\Models;

use App\Models\UmkmProfile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'umkm_id',
        'product_name',
        'price',
        'quantity',
    ];

    // Relasi ke order (sudah ada)
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // RELASI YANG HILANG: Ke Produk
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function umkmProfile(): BelongsTo
    {
        return $this->belongsTo(UmkmProfile::class);
    }
}
