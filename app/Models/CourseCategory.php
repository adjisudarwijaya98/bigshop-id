<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseCategory extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     * Secara default Laravel akan menggunakan 'course_categories'.
     *
     * @var string
     */
    protected $table = 'course_categories';

    /**
     * The attributes that are mass assignable.
     * Termasuk kolom 'image_url' untuk thumbnail kategori.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'image_url',
    ];

    /**
     * Relasi: Satu Kategori memiliki banyak Kursus (One-to-Many).
     */
    public function courses()
    {
        return $this->hasMany(Course::class, 'category_id'); // Menggunakan category_id sebagai foreign key
    }
}
