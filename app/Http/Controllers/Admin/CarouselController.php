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
            // PERBAIKAN: Mengganti 'public' disk menjadi 'uploads' disk.
            // File sekarang akan disimpan di public/uploads/carousels
            $imagePath = $request->file('image')->store('carousels', 'uploads');
            // Tambahkan path ke data yang divalidasi, sesuai dengan kolom 'image_url'
            $validated['image_url'] = $imagePath;
        }

        // 3. Simpan Data ke Database
        Carousel::create([
            'title' => $validated['title'],
            'subtitle' => $validated['subtitle'] ?? null,
            'image_url' => $validated['image_url'], // Menggunakan path hasil upload
            'button_text' => $validated['button_text'] ?? null,
            'button_link' => $validated['button_link'] ?? null,
        ]);

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
            // PERBAIKAN: Menggunakan 'uploads' disk saat menghapus
            if ($carousel->image_url) {
                // Periksa apakah path benar-benar ada sebelum menghapus
                Storage::disk('uploads')->delete($carousel->image_url);
            }

            // Simpan gambar baru
            // PERBAIKAN: Mengganti 'public' disk menjadi 'uploads' disk.
            $imagePath = $request->file('image')->store('carousels', 'uploads');
            $validated['image_url'] = $imagePath;

            // Hapus kunci 'image' dari $validated agar tidak disimpan ke kolom database yang salah
            unset($validated['image']);
        } else {
            // Jika tidak ada gambar baru, pastikan kolom 'image_url' tetap menggunakan path lama
            // Ini tidak wajib jika Anda menggunakan fillable/guarded, tetapi aman untuk dilakukan
            $validated['image_url'] = $carousel->image_url;
            // Hapus kunci 'image' dari $validated
            unset($validated['image']);
        }

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
        // PERBAIKAN: Menggunakan 'uploads' disk saat menghapus
        if ($carousel->image_url) {
            Storage::disk('uploads')->delete($carousel->image_url);
        }

        // Hapus record dari database
        $carousel->delete();

        return redirect()->route('admin.carousels.index')
            ->with('success', 'Banner carousel berhasil dihapus.');
    }
}
