@extends('layouts.main')

@section('title', 'Marketplace Produk UMKM - Bigshop.Id')

@section('content')

    <section class="bg-red-700 py-24 text-center text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-t from-red-800/20 to-red-700/50"></div>
        <div class="container mx-auto px-6 relative z-10">
            <h1 class="text-5xl md:text-6xl font-extrabold mb-4 tracking-tight leading-none drop-shadow-xl">
                MARKETPLACE UMKM PILIHAN
            </h1>
            <p class="text-xl md:text-2xl text-red-100 max-w-3xl mx-auto drop-shadow-lg">
                Temukan dan dukung ribuan produk berkualitas dari pengusaha mikro, kecil, dan menengah di seluruh Indonesia.
            </p>
        </div>
    </section>

    <section class="py-12">
        <div class="container mx-auto px-6">

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-10">

                <aside class="lg:col-span-1">
                    {{-- Form ini akan mengirimkan filter ke URL menggunakan method GET --}}
                    <form method="GET" action="/marketplace" class="bg-white p-6 rounded-lg shadow-lg sticky top-28">
                        <h3 class="text-xl font-bold mb-4 text-gray-800">Filter Pencarian</h3>

                        <div class="mb-6">
                            <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Cari Produk</label>
                            <input type="text" name="search" id="search" placeholder="Masukkan kata kunci..."
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500"
                                value="{{ request('search') }}">
                        </div>

                        <div class="mb-6">
                            <h4 class="text-lg font-semibold mb-3 border-b pb-2">Kategori Produk</h4>

                            <ul class="space-y-2">
                                {{-- Opsi: Semua Produk --}}
                                <li>
                                    <a href="/marketplace?search={{ request('search') }}"
                                        class="text-gray-600 hover:text-red-600 @if (!request('category')) font-bold text-red-600 @endif">
                                        Semua Produk
                                    </a>
                                </li>

                                {{-- Loop Kategori Dinamis --}}
                                @foreach ($categories as $category)
                                    <li>
                                        <a href="/marketplace?category={{ $category->id }}&search={{ request('search') }}"
                                            class="text-gray-600 hover:text-red-600 @if (request('category') == $category->id) font-bold text-red-600 @endif">
                                            {{ $category->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </form>
                </aside>

                <div class="lg:col-span-3">
                    <h2 class="text-2xl font-bold text-gray-800 mb-8">
                        {{-- Ini akan menjadi tempat jumlah produk ditampilkan --}}
                        100% Asli Produk Indonesia
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                        @foreach ($products as $product)
                            <div
                                class="bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-105 transition-transform duration-300">

                                {{-- LOGIC PATH GAMBAR YANG DIPERBAIKI --}}
                                @php
                                    // 1. Ambil path, gunakan placeholder jika null.
                                    $rawPath = $product->image_url ?? 'placeholders/product-default.png';

                                    // 2. Pastikan path diawali dengan 'storage/' untuk resolusi melalui symlink,
                                    // asumsikan path yang tersimpan di DB adalah relatif (e.g., 'products/image.jpg').
                                    $finalPath = str_starts_with($rawPath, 'storage/')
                                        ? $rawPath
                                        : 'storage/' . $rawPath;
                                @endphp

                                <img class="w-full h-48 object-cover" src="{{ asset($finalPath) }}"
                                    alt="{{ $product->name }}">
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold mb-1 truncate">{{ $product->name }}</h3>
                                    <p class="text-gray-600 mb-2 font-bold text-lg">Rp
                                        {{ number_format($product->price, 0, ',', '.') }}</p>

                                    {{-- PERBAIKAN NAMA TOKO: Mengambil nama UMKM dari relasi --}}
                                    <p class="text-sm text-gray-500 mb-2">Toko:
                                        {{ $product->umkm->name ?? 'UMKM Tidak Ditemukan' }}</p>

                                    <a href="/product/{{ $product->slug }}"
                                        class="mt-4 block w-full bg-red-600 text-white text-center font-semibold py-2 rounded-full hover:bg-red-700 transition duration-300">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
