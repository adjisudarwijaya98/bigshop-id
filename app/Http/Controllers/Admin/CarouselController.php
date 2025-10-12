<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carousel; // Import Model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    /**
     * Menampilkan daftar semua carousel.
     */
    public function index()
    {
        // Mengambil semua carousel, diurutkan berdasarkan yang terbaru dibuat
        $carousels = Carousel::orderBy('created_at', 'desc')->paginate(10);
        return view('pages.admin.carousels.index', compact('carousels'));
    }

    /**
     * Menampilkan form untuk membuat carousel baru.
     */
    public function create()
    {
        return view('pages.admin.carousels.create');
    }

    /**
     * Menyimpan carousel baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            // Gunakan 'image' sebagai kunci, dan 'mimes' untuk semua format gambar umum
            'image' => 'required|mimes:jpg,jpeg,png,webp,svg,gif,ico,bmp|max:8096',
            'button_text' => 'nullable|string|max:50',
            'button_link' => 'nullable|url|max:255',
        ]);

        // 2. Proses Upload Gambar
        $imagePath = null;
        if ($request->hasFile('image')) {
            // PERUBAHAN: Menggunakan disk 'public'.
            // File akan disimpan di storage/app/public/carousels
            $imagePath = $request->file('image')->store('carousels', 'public');
            // Path yang tersimpan di DB adalah 'carousels/namafile.jpg'
            $validated['image_url'] = $imagePath;

            // Hapus kunci 'image' karena kita hanya menyimpan 'image_url' di database
            unset($validated['image']);
        }

        // 3. Simpan Data ke Database
        Carousel::create($validated);

        return redirect()->route('admin.carousels.index')
            ->with('success', 'Banner carousel baru berhasil ditambahkan dan diunggah!');
    }

    /**
     * Menampilkan form untuk mengedit carousel.
     */
    public function edit(Carousel $carousel)
    {
        return view('pages.admin.carousels.edit', compact('carousel'));
    }

    /**
     * Memperbarui carousel yang sudah ada.
     */
    public function update(Request $request, Carousel $carousel)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255', // Wajib diisi
            'subtitle' => 'nullable|string|max:255',
            // Gambar tidak wajib diisi saat update, hanya jika ada file baru
            'image' => 'nullable|mimes:jpg,jpeg,png,webp,svg,gif,ico,bmp|max:8096',
            'button_text' => 'nullable|string|max:50',
            'button_link' => 'nullable|url|max:255',
        ]);

        // Proses Update Gambar (Jika ada file baru diupload)
        if ($request->hasFile('image')) {
            // Hapus gambar lama dari storage terlebih dahulu
            // PERUBAHAN: Menggunakan disk 'public' saat menghapus
            if ($carousel->image_url && Storage::disk('public')->exists($carousel->image_url)) {
                Storage::disk('public')->delete($carousel->image_url);
            }

            // Simpan gambar baru
            // PERUBAHAN: Menggunakan disk 'public'
            $imagePath = $request->file('image')->store('carousels', 'public');
            $validated['image_url'] = $imagePath;
        }

        // Hapus kunci 'image' dari $validated karena tidak ada di kolom database
        unset($validated['image']);

        // Update data di database
        $carousel->update($validated);

        return redirect()->route('admin.carousels.index')
            ->with('success', 'Banner carousel berhasil diperbarui.');
    }

    /**
     * Menghapus carousel dari database.
     */
    public function destroy(Carousel $carousel)
    {
        // Hapus gambar dari storage terlebih dahulu
        // PERUBAHAN: Menggunakan disk 'public' saat menghapus
        if ($carousel->image_url) {
            // Pastikan file benar-benar ada di disk public sebelum mencoba menghapus
            if (Storage::disk('public')->exists($carousel->image_url)) {
                Storage::disk('public')->delete($carousel->image_url);
            }
        }

        // Hapus record dari database
        $carousel->delete();

        return redirect()->route('admin.carousels.index')
            ->with('success', 'Banner carousel berhasil dihapus.');
    }
}
