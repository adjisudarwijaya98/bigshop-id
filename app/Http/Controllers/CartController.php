<?php

namespace App\Http\Controllers;

use App\Models\Product; // Pastikan Model Produk diimpor
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Menampilkan isi Keranjang Belanja.
     */
    public function index()
    {
        // Logika tampilan akan ada di sini
        $cart = session()->get('cart', []);

        // Kita akan membuat view-nya di langkah berikutnya
        return view('pages.cart.index', compact('cart'));
    }

    /**
     * Menambahkan produk ke Keranjang Belanja (Session).
     */
    public function add(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);
        $productId = $product->id;
        $quantity = $request->input('quantity', 1); // Ambil kuantitas dari form, default 1

        if (isset($cart[$productId])) {
            // Jika produk sudah ada, tambahkan kuantitasnya
            $cart[$productId]['quantity'] += $quantity;
        } else {
            // Jika produk belum ada, tambahkan sebagai item baru
            $cart[$productId] = [
                "id" => $productId,
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $product->price,
                "image_url" => $product->image_url
            ];
        }

        session()->put('cart', $cart);

        // Redirect kembali ke halaman detail produk dengan pesan sukses
        return redirect()->back()->with('success', $product->name . ' berhasil ditambahkan ke keranjang!');
    }

    /**
     * Menghapus item dari Keranjang Belanja (Akan diimplementasikan nanti).
     */
    /**
     * Menghapus item dari Keranjang Belanja (Session).
     */
    public function remove(Product $product)
    {
        $cart = session()->get('cart');
        $productId = $product->id;

        if (isset($cart[$productId])) {
            // Hapus item dari array cart
            unset($cart[$productId]);

            // Simpan kembali array cart ke session
            session()->put('cart', $cart);

            // Beri pesan notifikasi
            return redirect()->back()->with('success', $product->name . ' berhasil dihapus dari keranjang.');
        }

        // Jika produk tidak ditemukan di keranjang
        return redirect()->back()->with('error', 'Produk tidak ditemukan di keranjang.');
    }
}
