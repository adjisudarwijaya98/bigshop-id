<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Product;
use Illuminate\Contracts\View\View; // Import untuk tipe-hinting

class HomeController extends Controller
{
    /**
     * Tampilkan halaman utama (homepage).
     *
     * @return View
     */
    public function index(): View
    {
        // 1. Ambil semua data Carousel
        $carousels = Carousel::get(); // Menggunakan get() daripada all()

        // 2. Ambil 4 produk terbaru saja (diurutkan berdasarkan ID terbaru / DESC)
        $products = Product::orderBy('id', 'desc')
            ->limit(4)
            ->get();

        // 3. Kirim kedua data ke view 'pages.home'
        return view('pages.home', compact('carousels', 'products'));
    }
}
