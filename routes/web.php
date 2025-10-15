<?php

use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ElearningController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\UmkmProfileController;
use App\Http\Controllers\Admin\CarouselController;


/*
|--------------------------------------------------------------------------
| Custom Bigshop Routes
|--------------------------------------------------------------------------
*/

// RUTE HALAMAN UTAMA KUSTOM ANDA
Route::get('/', [HomeController::class, 'index'])->name('home');

// RUTE MARKETPLACE
Route::get('/marketplace', [ProductController::class, 'index'])->name('marketplace');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');

/*
|--------------------------------------------------------------------------
| UMKM Dashboard Routes (Protected)
|--------------------------------------------------------------------------
*/
Route::prefix('umkm')->middleware(['auth', 'is_umkm'])->group(function () {
    // Dashboard Utama UMKM
    Route::get('/dashboard', [UmkmController::class, 'index'])->name('umkm.dashboard');
    Route::get('/products', [UmkmController::class, 'productsIndex'])->name('umkm.products.index');
    // Rute manajemen produk akan kita tambahkan di sini
    // Rute untuk menampilkan form Tambah Produk
    Route::get('/products/create', [UmkmController::class, 'create'])->name('umkm.products.create');
    Route::get('/edit', [UmkmProfileController::class, 'edit'])
        ->name('umkm.profile.edit');
    Route::put('/profile/umkm', [UmkmProfileController::class, 'update'])->name('umkm.profile.update');

    // Rute untuk memproses data dari form (Akan kita gunakan di langkah selanjutnya)
    Route::post('/products', [UmkmController::class, 'store'])->name('umkm.products.store');
    // Rute untuk menampilkan form Edit Produk
    Route::get('/products/{product}/edit', [UmkmController::class, 'edit'])->name('umkm.products.edit');

    // Rute untuk memproses update data
    Route::put('/products/{product}', [UmkmController::class, 'update'])->name('umkm.products.update');
    // Rute untuk menghapus data produk
    Route::delete('/products/{product}', [UmkmController::class, 'destroy'])->name('umkm.products.destroy');
    Route::get('/order/{order}/confirmation', [CheckoutController::class, 'confirmation'])->name('order.confirmation');

    Route::get('/orders', [UmkmController::class, 'ordersIndex'])->name('umkm.orders.index');
    Route::get('/orders/{orderItem}', [UmkmController::class, 'ordersShow'])->name('umkm.orders.show');
    Route::post('/orders/{orderItem}/update-status', [UmkmController::class, 'updateStatus'])->name('umkm.orders.update_status');
});

/*
|--------------------------------------------------------------------------
| Cart (Keranjang Belanja) Routes
|--------------------------------------------------------------------------
*/
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');

/*
|--------------------------------------------------------------------------
| Checkout Routes (Wajib Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/orders', [CheckoutController::class, 'history'])->name('user.orders.history');
    Route::get('/orders/{order}', [CheckoutController::class, 'show'])->name('user.orders.show');
});
Route::prefix('e-learning')->name('e_learning.')->group(function () {
    // Rute Index (Menampilkan semua Kategori)
    Route::get('/', [ElearningController::class, 'index'])->name('categories.index');

    // Rute Daftar Kursus berdasarkan Kategori (Slug)
    Route::get('{slug}', [ElearningController::class, 'coursesByCategory'])->name('courses.index');

    // Rute Detail Kursus
    // Route::get('{slug}/{course}', [ElearningController::class, 'showCourse'])->name('course.show');
});

// Rute Admin Dashboard & Monitoring
Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {


    // Admin Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // --- MANAJEMEN PESANAN ---
    Route::get('/orders', [AdminController::class, 'orderIndex'])->name('admin.orders.index');
    Route::get('/orders/{order}', [AdminController::class, 'orderShow'])->name('admin.orders.show');

    // --- MANAJEMEN UMKM (INI YANG ERROR) ---
    // 1. Route Daftar Mitra (admin.umkms.index)
    Route::get('/umkms', [AdminController::class, 'umkmIndex'])->name('admin.umkms.index');

    // 2. Route Tambah Baru (admin.umkms.create & store)
    Route::get('/umkms/create', [AdminController::class, 'umkmCreate'])->name('admin.umkms.create');
    Route::post('/umkms', [AdminController::class, 'umkmStore'])->name('admin.umkms.store');

    // 3. Route Toggle Status
    Route::post('/umkms/{umkm}/toggle-status', [AdminController::class, 'toggleUmkmStatus'])->name('admin.umkms.toggle_status');

    // 4. Route Manajemen Produk
    Route::get('/products', [AdminController::class, 'productIndex'])->name('admin.products.index');
    // Route BARU: Hapus Produk
    Route::delete('/products/{product}', [AdminController::class, 'productDestroy'])->name('admin.products.destroy');
    // Jika perlu moderasi/edit, tambahkan:
    // Route::get('/products/{product}/edit', [AdminController::class, 'productEdit'])->name('products.edit');

    // Route BARU: Mengubah Role Pengguna
    Route::get('/users', [AdminController::class, 'userIndex'])->name('admin.users.index');
    Route::post('/users/{user}/toggle-admin', [AdminController::class, 'toggleAdminRole'])->name('admin.users.toggle-admin');
    Route::delete('/users/{user}', [AdminController::class, 'userDestroy'])->name('admin.users.destroy');

    Route::resource('carousels', Admin\CarouselController::class)->except(['show']);
    Route::get('/caroulses', [Admin\CarouselController::class, 'index'])->name('admin.carousels.index');
    Route::get('/create', [Admin\CarouselController::class, 'create'])->name('admin.carousels.create');
    // Tampilkan form edit banner (GET /admin/carousels/{carousel}/edit)
    Route::get('/{carousel}/edit', [Admin\CarouselController::class, 'edit'])->name('admin.carousels.edit');
    // Update data banner (PUT/PATCH /admin/carousels/{carousel})
    Route::put(
        '/{carousel}',
        [Admin\CarouselController::class, 'update']
    )->name('admin.carousels.update');
    Route::post('/', [Admin\CarouselController::class, 'store'])->name('admin.carousels.store');
    // Hapus banner (DELETE /admin/carousels/{carousel})
    Route::delete('/{carousel}', [Admin\CarouselController::class, 'destroy'])->name('admin.carousels.destroy');
});
/*
|--------------------------------------------------------------------------
| Laravel Breeze Authentication Routes (JANGAN DIGANTI)
|--------------------------------------------------------------------------
*/

// Anda bisa menghapus atau mengomentari baris Route::get('/dashboard') bawaan Breeze
// jika tidak ingin menggunakannya. Biarkan file auth.php yang menangani login/register.

require __DIR__ . '/auth.php';
