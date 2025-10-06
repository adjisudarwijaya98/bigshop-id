<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Http\Requests\StoreProductRequest; // Import Request Validasi
use Illuminate\Http\Request;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Import Storage untuk gambar
use Illuminate\Support\Str; // Import Str untuk membuat slug

class UmkmController extends Controller
{
    public function index()
    {
        return view('pages.umkm.dashboard');
    }

    public function productsIndex()
    {
        $umkmId = Auth::id();
        $products = Product::where('umkm_id', $umkmId)->get();

        return view('pages.umkm.products.index', compact('products'));
    }

    public function create()
    {
        $categories = ProductCategory::all();

        return view('pages.umkm.products.create', compact('categories'));
    }

    /**
     * Menyimpan produk baru ke database.
     */
    public function store(StoreProductRequest $request)
    {
        // 1. Validasi data sudah dilakukan oleh StoreProductRequest

        $data = $request->validated();

        // 2. Proses Upload Gambar
        // FIX: Ubah folder penyimpanan menjadi 'uploads/products'
        $path = $request->file('image')->store('uploads/products', 'public');

        // 3. Buat Slug
        $slug = Str::slug($data['name']);

        // 4. Siapkan Data untuk Database
        $newProduct = [
            'umkm_id' => Auth::id(), // Kunci Foreign ID user yang sedang login
            'category_id' => $data['category_id'],
            'name' => $data['name'],
            'slug' => $slug,
            'description' => $data['description'],
            'price' => $data['price'],
            'stock' => $data['stock'],
            'image_url' => $path, // Simpan path gambar (mis: uploads/products/xyz.jpg)
        ];

        // 5. Simpan Produk
        Product::create($newProduct);

        // 6. Redirect dengan pesan sukses
        return redirect()->route('umkm.products.index')
            ->with('success', 'Produk baru berhasil ditambahkan!');
    }
    public function edit(Product $product)
    {
        // Pastikan hanya pemilik produk yang bisa mengedit
        if ($product->umkm_id !== Auth::id()) {
            abort(403, 'Akses Ditolak. Anda bukan pemilik produk ini.');
        }

        $categories = ProductCategory::all();

        return view('pages.umkm.products.edit', compact('product', 'categories'));
    }

    /**
     * Memperbarui data produk di database.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        // Pastikan hanya pemilik produk yang bisa mengupdate
        if ($product->umkm_id !== Auth::id()) {
            abort(403, 'Akses Ditolak. Anda bukan pemilik produk ini.');
        }

        $data = $request->validated();
        $path = $product->image_url; // Default: gunakan path gambar lama

        // 1. Cek dan Proses Upload Gambar Baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama (penting untuk menjaga storage)
            if ($product->image_url && Storage::disk('public')->exists($product->image_url)) {
                Storage::disk('public')->delete($product->image_url);
            }
            // Simpan gambar baru
            // FIX: Ubah folder penyimpanan menjadi 'uploads/products'
            $path = $request->file('image')->store('uploads/products', 'public');
        }

        // 2. Buat Slug Baru dari Nama Produk (jika nama berubah)
        $slug = Str::slug($data['name']);

        // 3. Update Data Produk
        $product->update([
            'category_id' => $data['category_id'],
            'name' => $data['name'],
            'slug' => $slug,
            'description' => $data['description'],
            'price' => $data['price'],
            'stock' => $data['stock'],
            'image_url' => $path,
        ]);

        // 4. Redirect dengan pesan sukses
        return redirect()->route('umkm.products.index')
            ->with('success', 'Produk berhasil diperbarui!');
    }
    /**
     * Menghapus produk dari database dan storage.
     */
    public function destroy(Product $product)
    {
        // 1. Pastikan hanya pemilik produk yang bisa menghapus
        if ($product->umkm_id !== Auth::id()) {
            abort(403, 'Akses Ditolak. Anda bukan pemilik produk ini.');
        }

        // 2. Hapus File Gambar dari Storage
        // Path penghapusan sudah benar, karena image_url menyimpan path relatif disk (sekarang 'uploads/products/...')
        if ($product->image_url && Storage::disk('public')->exists($product->image_url)) {
            Storage::disk('public')->delete($product->image_url);
        }

        // 3. Hapus Produk dari Database
        $product->delete();

        // 4. Redirect dengan pesan sukses
        return redirect()->route('umkm.products.index')
            ->with('success', 'Produk berhasil dihapus!');
    }

    /**
     * Menampilkan daftar item pesanan yang diterima UMKM.
     */
    public function ordersIndex()
    {
        $umkmId = Auth::id();

        // Ambil semua OrderItem yang terkait dengan UMKM ini,
        // dan load order induknya untuk detail alamat.
        $orderItems = OrderItem::where('umkm_id', $umkmId)
            ->with('order')
            ->orderByDesc('created_at')
            ->get();

        return view('pages.umkm.orders.index', compact('orderItems'));
    }

    /**
     * Menampilkan detail item pesanan tertentu yang diterima UMKM.
     */
    public function ordersShow(OrderItem $orderItem)
    {
        $umkmId = Auth::id();

        // Security check: Pastikan item ini milik UMKM yang login
        if ($orderItem->umkm_id !== $umkmId) {
            abort(403, 'Akses Ditolak. Item pesanan ini bukan milik Anda.');
        }

        // Load detail order induk dan produk
        $orderItem->load(['order', 'product']);

        return view('pages.umkm.orders.show', compact('orderItem'));
    }

    /**
     * Mengubah status pesanan item (misalnya: diproses, dikirim).
     */
    public function updateStatus(Request $request, OrderItem $orderItem)
    {
        $umkmId = Auth::id();

        // Security check
        if ($orderItem->umkm_id !== $umkmId) {
            return redirect()->back()->with('error', 'Item pesanan tidak ditemukan atau bukan milik Anda.');
        }

        $request->validate([
            'status' => ['required', 'in:pending,processing,shipped,delivered,cancelled'],
        ]);

        // FIX LOGIC: Perbarui status pada OrderItem
        $orderItem->update(['status' => $request->status]);

        return redirect()->route('umkm.orders.show', $orderItem)
            ->with('success', 'Status pesanan berhasil diperbarui menjadi: ' . strtoupper($request->status));
    }
}
