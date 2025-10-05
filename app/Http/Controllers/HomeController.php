<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Product; // Tambahkan model Produk
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Tampilkan halaman utama (homepage).
     */
    public function index()
    {
        $carousels = Carousel::all();

        // Ambil 4 produk terbaru atau terlaris untuk ditampilkan di homepage
        $featuredProducts = Product::orderBy('id', 'desc')->limit(4)->get();

        // Kirim kedua data ke view
        return view('pages.home', compact('carousels', 'featuredProducts'));
    }
}
