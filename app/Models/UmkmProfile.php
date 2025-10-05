<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UmkmProfile extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'user_id',
        'store_name',
        'telepon',
        'description',
        'is_active',
        'location', // <-- GANTI 'address' dengan 'location' DI SINI
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function products(): HasMany
    {
        // Beri tahu Laravel: "Kunci di tabel 'products' adalah 'umkm_id'"
        return $this->hasMany(Product::class, 'umkm_id');
    }
}
