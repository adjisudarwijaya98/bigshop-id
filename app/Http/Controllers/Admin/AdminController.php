<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order; // Untuk data pesanan
use App\Models\User;  // Untuk data pengguna
use App\Models\UmkmProfile;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Menampilkan dashboard utama Admin dengan statistik.
     */
    public function dashboard()
    {
        // Hitung Metrik Utama
        $totalUsers = User::count();
        $totalUmkms = UmkmProfile::count();
        $totalProducts = Product::count();
        $activeUmkms = UmkmProfile::where('is_active', true)->count();

        // Anda bisa menambahkan perhitungan Total Pesanan di sini (jika tabel Order sudah ada)

        return view('pages.admin.dashboard', compact(
            'totalUsers',
            'totalUmkms',
            'totalProducts',
            'activeUmkms'
        ));
    }

    /**
     * Menampilkan daftar semua pesanan di seluruh marketplace untuk Admin.
     */
    public function orderIndex()
    {
        // Ambil semua pesanan, sekaligus load data user pemesan dan item di dalamnya
        $orders = Order::with('user', 'items')
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('pages.admin.orders.index', compact('orders'));
    }
    public function orderShow(Order $order)
    {
        // Load relasi yang diperlukan untuk ditampilkan di halaman detail
        $order->load('user', 'items.product', 'items.umkmProfile');

        return view('pages.admin.orders.show', compact('order'));
    }

    public function toggleUmkmStatus(UmkmProfile $umkm)
    {
        // Balikkan nilai is_active (true menjadi false, false menjadi true)
        $umkm->is_active = !$umkm->is_active;
        $umkm->save();

        $statusText = $umkm->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->route('admin.umkms.index')
            ->with('success', 'Status UMKM "' . $umkm->name . '" berhasil ' . $statusText . '.');
    }
    public function umkmCreate()
    {
        return view('pages.admin.umkms.create');
    }

    /**
     * Menyimpan data User dan UmkmProfile yang baru.
     */
    public function umkmStore(Request $request)
    {
        $request->validate([
            // Validasi User
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

            // FIX VALIDASI: Gunakan nama input dari form (phone_number), bukan nama kolom DB (telepon)
            'umkm_name' => ['required', 'string', 'max:255', 'unique:umkm_profiles,store_name'],
            'phone_number' => ['required', 'string', 'max:20'], // <-- INPUT NAME BENAR
            'address' => ['required', 'string'],
            // Catatan: description tidak divalidasi 'required' di sini
        ]);

        // 1. Buat Akun User Baru (Berhasil)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 2. Buat Profil UMKM (Bagian Kritis)
        $user->umkmProfile()->create([
            'store_name' => $request->umkm_name,
            'telepon' => $request->phone_number,

            // FIX TERAKHIR: Map DB 'location' <- Input 'address'
            'location' => $request->address,

            'description' => $request->description ?? 'Tidak ada deskripsi',
            'is_active' => true,
        ]);

        // Redirect dan notifikasi
        return redirect()->route('admin.umkms.index')
            ->with('success', 'Mitra UMKM "' . $request->umkm_name . '" berhasil dibuat dan diaktifkan.');
    }

    public function umkmIndex()
    {
        $umkms = UmkmProfile::with('user')
            ->orderBy('is_active', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        // Pastikan nama variabel yang dikirim adalah $umkms (jamak)
        return view('pages.admin.umkms.index', compact('umkms'));
    }

    /**
     * Menampilkan daftar semua produk dari semua UMKM.
     */
    public function productIndex()
    {
        // Ambil semua produk, dengan eager loading relasi umkmProfile
        $products = Product::with('umkmProfile.user')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('pages.admin.products.index', compact('products'));
    }

    public function productDestroy(Product $product)
    {
        $productName = $product->name;
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', "Produk '{$productName}' berhasil dihapus dari sistem.");
    }

    /**
     * Menampilkan daftar semua user di platform.
     */
    public function userIndex()
    {
        // Ambil semua user, urutkan berdasarkan created_at
        $users = User::orderBy('created_at', 'desc')
            ->paginate(20);

        return view('pages.admin.users.index', compact('users'));
    }


    public function toggleAdminRole(User $user)
    {
        // Cek: Jangan biarkan Admin menghapus status admin dirinya sendiri
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Anda tidak dapat mengubah status admin akun Anda sendiri.');
        }

        // Balikkan nilai is_admin
        $user->is_admin = !$user->is_admin;
        $user->save();

        // Tentukan pesan notifikasi
        $role = $user->is_admin ? 'ADMIN' : 'Pengguna Biasa';

        return redirect()->route('admin.users.index')
            ->with('success', "Role pengguna '{$user->name}' berhasil diubah menjadi {$role}.");
    }
}
