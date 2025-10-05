<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Requests\CheckoutRequest; // Tambahkan ini

class CheckoutController extends Controller
{
    /**
     * Menampilkan halaman Checkout dan form alamat pengiriman.
     */
    public function index()
    {
        $cart = session()->get('cart', []);

        // Cek apakah keranjang kosong
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja Anda kosong, silakan tambahkan produk terlebih dahulu.');
        }

        // Hitung total harga dan siapkan data
        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        // Ambil data default dari user yang login (jika ada)
        $user = auth()->user();

        return view('pages.checkout.index', compact('cart', 'totalPrice', 'user'));
    }

    /**
     * Memproses pesanan dan menyimpannya ke database (akan diisi di langkah berikutnya).
     */
    public function store(CheckoutRequest $request)
    {
        $validatedData = $request->validated();
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong saat checkout.');
        }

        // 1. Hitung ulang total harga (Wajib untuk keamanan)
        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        try {
            // 2. Gunakan Database Transaction
            DB::beginTransaction();

            // 3. Simpan Order Utama
            $order = Order::create([
                'user_id' => Auth::id(),
                'receiver_name' => $validatedData['receiver_name'],
                'receiver_phone' => $validatedData['receiver_phone'],
                'shipping_address' => $validatedData['shipping_address'],
                'shipping_city' => $validatedData['shipping_city'],
                'shipping_postal_code' => $validatedData['shipping_postal_code'],
                'total_price' => $totalPrice,
                'status' => 'pending_payment', // Status awal
            ]);

            // 4. Simpan Detail Item Order
            $orderItems = [];
            foreach ($cart as $item) {
                // Ambil UMKM ID dari produk saat ini
                $product = Product::find($item['id']);

                $orderItems[] = new OrderItem([
                    'product_id' => $item['id'],
                    'umkm_id' => $product->umkm_id, // Ambil ID UMKM dari produk
                    'product_name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                ]);
            }

            // Simpan semua order item dalam satu query
            $order->items()->saveMany($orderItems);

            // 5. Commit Transaction
            DB::commit();

            // 6. Kosongkan Keranjang (Session)
            session()->forget('cart');

            // 7. Redirect ke halaman konfirmasi
            return redirect()->route('order.confirmation', ['order' => $order->id])
                ->with('success', 'Pesanan Anda berhasil dibuat!');
        } catch (\Exception $e) {
            DB::rollBack();
            // Catat error ke log
            \Log::error('Checkout failed: ' . $e->getMessage());

            return redirect()->route('checkout.index')
                ->with('error', 'Gagal memproses pesanan. Silakan coba lagi.');
        }
    }
    public function confirmation(Order $order)
    {
        // Pastikan hanya pemilik order yang bisa melihat
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('pages.order.confirmation', compact('order'));
    }
    /**
     * Menampilkan daftar semua pesanan yang dibuat oleh user yang sedang login.
     */
    public function history()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('items') // Load detail itemnya sekalian
            ->orderByDesc('created_at')
            ->get();

        return view('pages.user.orders.history', compact('orders'));
    }

    /**
     * Menampilkan detail spesifik dari sebuah pesanan.
     */
    public function show(Order $order)
    {
        // Pastikan hanya pemilik order yang bisa melihat
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Akses Ditolak.');
        }

        // Kita load order item untuk ditampilkan
        $order->load('items.product');

        return view('pages.user.orders.show', compact('order'));
    }
}
