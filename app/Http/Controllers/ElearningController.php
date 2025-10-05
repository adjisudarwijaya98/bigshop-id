<?php

namespace App\Http\Controllers;

use App\Models\CourseCategory;
use App\Models\Course;
use Illuminate\Http\Request;

class ElearningController extends Controller
{
    /**
     * Menampilkan halaman utama E-Learning (daftar semua kategori).
     */
    public function index()
    {
        $categories = CourseCategory::withCount('courses')->orderBy('name', 'asc')->get();
        return view('pages.e_learning.index', compact('categories'));
    }

    /**
     * Menampilkan daftar kursus berdasarkan slug kategori.
     */
    public function coursesByCategory($slug)
    {
        // PENTING: Gunakan firstOrFail() untuk mendapatkan $category. 
        // Jika tidak ditemukan, Laravel akan otomatis memunculkan 404.
        $category = CourseCategory::where('slug', $slug)->firstOrFail();

        // Ambil kursus yang diterbitkan di kategori ini
        $courses = Course::where('category_id', $category->id)
            ->where('is_published', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        // VARIABEL $category DAN $courses DIKIRIM KE VIEW
        return view('pages.e_learning.courses.index', compact('category', 'courses'));
    }
}
