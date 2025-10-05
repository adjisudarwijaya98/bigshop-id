@extends('layouts.dashboard_layout')

@section('title', 'Dashboard UMKM - Bigshop.Id')

@section('content')
    <section class="py-16">
        <div class="container mx-auto px-6">
            <h1 class="text-4xl font-bold text-gray-800 mb-6">Selamat Datang, {{ Auth::user()->name }}!</h1>
            <p class="text-xl text-gray-600 mb-10">Ini adalah pusat manajemen toko UMKM Anda.</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <a href="#"
                    class="block p-6 bg-white rounded-xl shadow-lg hover:shadow-xl transition duration-300 border-t-4 border-red-600">
                    <h2 class="text-2xl font-semibold mb-2 text-red-600">Manajemen Produk</h2>
                    <p class="text-gray-600">Tambah, edit, dan hapus semua produk Anda.</p>
                </a>

                <a href="#"
                    class="block p-6 bg-white rounded-xl shadow-lg hover:shadow-xl transition duration-300 border-t-4 border-blue-600">
                    <h2 class="text-2xl font-semibold mb-2 text-blue-600">Daftar Pesanan</h2>
                    <p class="text-gray-600">Lihat semua pesanan masuk dan status pengiriman.</p>
                </a>

                <a href="#"
                    class="block p-6 bg-white rounded-xl shadow-lg hover:shadow-xl transition duration-300 border-t-4 border-green-600">
                    <h2 class="text-2xl font-semibold mb-2 text-green-600">Profil Toko</h2>
                    <p class="text-gray-600">Kelola informasi dan deskripsi toko Anda.</p>
                </a>
            </div>
        </div>
    </section>
@endsection
