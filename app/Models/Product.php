<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        // HANYA GUNAKAN SATU NAMA KOLOM FOREIGN KEY: umkm_id
        'umkm_id',
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'image_url',
        // Hapus 'umkm_profile_id' dari sini!
        'is_published'
    ];

    /**
     * Definisikan relasi ke UmkmProfile dan tunjuk ke kolom 'umkm_id'.
     */
    public function umkmProfile(): BelongsTo
    {
        // Beri tahu Laravel: "Kunci di tabel ini adalah 'umkm_id'"
        return $this->belongsTo(UmkmProfile::class, 'umkm_id');
    }
}
