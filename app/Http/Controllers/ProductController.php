<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory; // Import model Kategori
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Menampilkan daftar semua produk dengan filter dan pencarian.
     */
    public function index(Request $request)
    {
        // 1. Ambil semua kategori untuk sidebar
        $categories = ProductCategory::all();

        // 2. Mulai query produk
        $query = Product::query();

        // 3. Logika Pencarian (Search)
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        // 4. Logika Filter Kategori
        if ($request->filled('category') && $request->category != 0) {
            $query->where('category_id', $request->category);
        }

        // Eksekusi query dan ambil hasilnya
        $products = $query->get();

        // Kirim data ke view
        return view('pages.marketplace', compact('products', 'categories'));
    }
    /**
     * Menampilkan detail dari satu produk berdasarkan slug.
     */
    public function show($slug)
    {
        // Cari produk berdasarkan slug, atau tampilkan halaman 404 jika tidak ditemukan
        $product = Product::where('slug', $slug)
            ->firstOrFail();

        // Kita bisa ambil detail UMKM atau kategori di sini jika sudah ada relasi
        // Untuk sekarang, kita hanya kirim data produk
        return view('pages.product_detail', compact('product'));
    }
}
