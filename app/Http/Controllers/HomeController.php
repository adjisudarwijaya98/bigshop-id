<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Product; // Pastikan Product model di-import
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Tampilkan halaman utama (homepage).
     */
    public function index()
    {
        // 1. Ambil semua data Carousel
        $carousels = Carousel::all();

        // 2. Ambil 4 produk terbaru (orderBy('id', 'desc')) untuk ditampilkan
        $featuredProducts = Product::orderBy('id', 'desc')->limit(4)->get();

        // 3. Kirim kedua data ke view 'pages.home'
        return view('pages.home', compact('carousels', 'featuredProducts'));
    }
}
