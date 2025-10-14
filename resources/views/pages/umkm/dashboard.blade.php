@extends('layouts.dashboard_layout')

@section('title', 'Dashboard UMKM - Bigshop.Id')

@section('content')
    <div class="space-y-10">

        {{-- Area Sambutan (Hero) --}}
        <header>
            <h1 class="text-3xl font-extrabold text-gray-900 mb-1">Selamat Datang, {{ Auth::user()->name }}!</h1>
            <p class="text-lg text-gray-500">Ini adalah pusat manajemen toko UMKM Anda. Mari kita kelola bisnis Anda hari
                ini.</p>
        </header>

        {{-- Area Kartu Aksi Utama (Grid) --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            {{-- Kartu: Manajemen Produk (Aksen Merah - Sesuai Brand) --}}
            <a href="{{ route('umkm.products.index') }}"
                class="block p-6 bg-white rounded-xl shadow-lg border border-gray-100 transform hover:-translate-y-1 hover:shadow-2xl transition duration-300">
                <div class="flex items-start space-x-4">
                    {{-- Ikon Produk (Box/Package) --}}
                    <div class="p-3 rounded-full bg-red-100 text-red-600 flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10m0-10l8 4m-8 4l-8 4">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold mb-1 text-red-700">Manajemen Produk</h2>
                        <p class="text-gray-500 text-sm">Tambah, edit, dan kelola inventaris produk Anda.</p>
                    </div>
                </div>
            </a>

            {{-- Kartu: Daftar Pesanan (Aksen Biru - Standar untuk Transaksi) --}}
            <a href="{{ route('umkm.orders.index') }}"
                class="block p-6 bg-white rounded-xl shadow-lg border border-gray-100 transform hover:-translate-y-1 hover:shadow-2xl transition duration-300">
                <div class="flex items-start space-x-4">
                    {{-- Ikon Pesanan (Shopping Cart) --}}
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600 flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.767.707 1.767H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold mb-1 text-blue-700">Daftar Pesanan</h2>
                        <p class="text-gray-500 text-sm">Lihat, proses, dan lacak status semua pesanan masuk.</p>
                    </div>
                </div>
            </a>

            {{-- Kartu: Profil Toko (Aksen Hijau - Standar untuk Pengaturan/Profil) --}}
            <a href="{{ route('umkm.profile.edit') }}"
                class="block p-6 bg-white rounded-xl shadow-lg border border-gray-100 transform hover:-translate-y-1 hover:shadow-2xl transition duration-300">
                <div class="flex items-start space-x-4">
                    {{-- Ikon Profil (Store) --}}
                    <div class="p-3 rounded-full bg-green-100 text-green-600 flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold mb-1 text-green-700">Profil Toko</h2>
                        <p class="text-gray-500 text-sm">Perbarui informasi toko, alamat, dan deskripsi Anda.</p>
                    </div>
                </div>
            </a>
        </div>

        {{-- Anda bisa menambahkan bagian lain di sini, seperti ringkasan metrik --}}

    </div>
@endsection
