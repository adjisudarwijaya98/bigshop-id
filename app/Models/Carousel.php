<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    use HasFactory;

    protected $fillable = [
        // Kolom dari migration Anda:
        'title',
        'subtitle',
        'image_url', // Menggunakan image_url (bukan image_path)
        'button_text',
        'button_link',

        // Kolom fungsional yang umum digunakan (sebaiknya ada di migration Anda)
        'order',
        'is_active',
    ];
}
