<?php

namespace App\Http\Controllers;

use App\Models\UmkmProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UmkmProfileController extends Controller
{
    /**
     * Tampilkan formulir untuk mengedit profil UMKM yang sedang login.
     * Membuat profil default jika belum ada.
     */
    public function edit()
    {
        $user = Auth::user();
        // MENGAMBIL DATA UMKM: Variabel $umkm berisi data dari tabel umkm_profiles
        // melalui relasi 'umkm' yang ada di Model User.
        $umkm = $user->umkm;

        // Jika profil UMKM belum ada, buat data dasarnya
        if (!$umkm) {
            $umkm = UmkmProfile::create([
                'user_id' => $user->id,
                // PERBAIKAN: Menggunakan $user->name (dari tabel users) untuk nama default
                'store_name' => 'Toko ' . $user->name,
                'telepon' => null,
                'description' => 'Silakan lengkapi deskripsi toko Anda.',
                'is_active' => true,
                'location' => null,
            ]);

            session()->flash('info', 'Profil toko Anda telah dibuat secara otomatis. Mohon lengkapi detailnya.');
        }

        // Tampilkan view edit profil menggunakan objek $umkm (data dari tabel UmkmProfile)
        return view('pages.umkm.profile.edit', compact('umkm'));
    }

    /**
     * Memperbarui data profil UMKM di database.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $umkm = $user->umkm;

        if (!$umkm) {
            return redirect()->back()->with('error', 'Profil UMKM tidak ditemukan.');
        }

        // 1. Validasi Data yang Diperbarui
        $request->validate([
            'store_name' => 'required|string|max:255',
            'telepon' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:500',
            'description' => 'nullable|string|max:1000',
        ]);

        // 2. Proses Pembaruan Data
        $umkm->update([
            'store_name' => $request->store_name,
            'telepon' => $request->telepon,
            'location' => $request->location,
            'description' => $request->description,
            // Penanganan checkbox 'is_active'
            'is_active' => $request->has('is_active'),
        ]);

        // 3. Redirect dengan pesan sukses
        return redirect()->route('umkm.profile.edit')
            ->with('success', 'Profil toko berhasil diperbarui!');
    }
}
