@extends('layouts.admin_dashboard_layout')

@section('title', 'Dashboard Admin')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Dashboard Utama</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        {{-- Card 1: Total Pengguna --}}
        <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-100">
            <p class="text-sm font-medium text-gray-500">Total Pengguna</p>
            <p class="text-4xl font-bold text-gray-900 mt-1">{{ number_format($totalUsers, 0, ',', '.') }}</p>
        </div>

        {{-- Card 2: Total UMKM --}}
        <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-100">
            <p class="text-sm font-medium text-gray-500">Total Mitra UMKM</p>
            <p class="text-4xl font-bold text-gray-900 mt-1">{{ number_format($totalUmkms, 0, ',', '.') }}</p>
        </div>

        {{-- Card 3: UMKM Aktif --}}
        <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-100">
            <p class="text-sm font-medium text-gray-500">Mitra Aktif</p>
            <p class="text-4xl font-bold text-green-600 mt-1">{{ number_format($activeUmkms, 0, ',', '.') }}</p>
        </div>

        {{-- Card 4: Total Produk --}}
        <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-100">
            <p class="text-sm font-medium text-gray-500">Total Produk Tayang</p>
            <p class="text-4xl font-bold text-gray-900 mt-1">{{ number_format($totalProducts, 0, ',', '.') }}</p>
        </div>

    </div>

    <div class="mt-8 p-6 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-lg">
        <p class="font-semibold">Selamat!</p>
        <p>Anda telah berhasil membangun kerangka Admin Panel yang kuat dan siap digunakan untuk mengelola UMKM, Produk, dan
            Pengguna Anda.</p>
    </div>
@endsection
