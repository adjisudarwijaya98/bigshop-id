<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Models\CourseCategory;
use App\Http\Controllers\Controller;
use App\Models\Lesson; // Asumsikan Anda punya model Lesson

class LessonController extends Controller
{
    /**
     * Menampilkan daftar semua kategori kursus.
     */
    public function index()
    {
        $categories = CourseCategory::orderBy('name', 'asc')->paginate(10);
        return view('pages.admin.categories.index', compact('categories'));
    }

    /**
     * Menampilkan form untuk membuat kategori baru.
     */
    public function create()
    {
        return view('pages.admin.categories.create');
    }

    /**
     * Menyimpan kategori baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:course_categories,name', // Unique di tabel course_categories
            'slug' => 'required|string|max:100|unique:course_categories,slug',
            'image' => 'nullable|mimes:svg,png,jpg,jpeg,webp|max:2048', // Untuk ikon/thumbnail
        ]);

        // 2. Proses Upload Gambar
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('course_categories', 'public');
        }

        // 3. Simpan Data ke Database
        CourseCategory::create([
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'image_url' => $imagePath,
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori kursus baru berhasil ditambahkan!');
    }

    /**
     * Menampilkan form untuk mengedit kategori.
     */
    public function edit(CourseCategory $category)
    {
        return view('pages.admin.categories.edit', compact('category'));
    }

    /**
     * Memperbarui kategori yang sudah ada.
     */
    public function update(Request $request, CourseCategory $category)
    {
        // 1. Validasi Input
        $rules = [
            // Abaikan unique validation jika name/slug tidak berubah
            'name' => 'required|string|max:100|unique:course_categories,name,' . $category->id,
            'slug' => 'required|string|max:100|unique:course_categories,slug,' . $category->id,
            'image' => 'nullable|mimes:svg,png,jpg,jpeg,webp|max:2048',
        ];

        $validated = $request->validate($rules);

        // 2. Proses Update Gambar (Jika ada file baru diupload)
        if ($request->hasFile('image')) {
            // Hapus gambar lama dari storage jika ada
            if ($category->image_url) {
                Storage::disk('public')->delete($category->image_url);
            }
            // Simpan gambar baru
            $validated['image_url'] = $request->file('image')->store('course_categories', 'public');
        } else {
            // Pertahankan image_url yang lama
            $validated['image_url'] = $category->image_url;
        }

        // Hapus kunci 'image' agar tidak disimpan ke kolom database
        unset($validated['image']);

        // 3. Update data di database
        $category->update($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori kursus berhasil diperbarui.');
    }

    /**
     * Menghapus kategori dari database.
     */
    public function destroy(CourseCategory $category)
    {
        // Hapus gambar dari storage
        if ($category->image_url) {
            Storage::disk('public')->delete($category->image_url);
        }

        // Hapus record dari database
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori kursus berhasil dihapus.');
    }
}
