@extends('layouts.dashboard_layout')

@section('title', 'Manajemen Produk - Bigshop.Id')

@section('content')
    {{-- PESAN SUKSES --}}
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p class="font-bold">Berhasil!</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Manajemen Produk</h1>
        {{-- Tombol untuk menambah produk baru --}}
        <a href="{{ route('umkm.products.create') }}"
            class="bg-red-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-red-700 transition duration-300">
            + Tambah Produk Baru
        </a>
    </div>

    <div class="bg-white shadow-xl rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gambar</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Produk
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($products as $product)
                    <tr>
                        {{-- BLOK GAMBAR YANG TELAH DIPERBAIKI DENGAN FALLBACK --}}
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($product->image_url)
                                <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}"
                                    class="h-10 w-10 rounded object-cover shadow-sm">
                            @else
                                {{-- Placeholder jika gambar tidak tersedia --}}
                                <div
                                    class="h-10 w-10 flex items-center justify-center bg-gray-200 text-gray-500 rounded shadow-sm text-xs font-semibold">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L15 15m0 0l4.586-4.586a2 2 0 012.828 0L24 14m-4-10H4a2 2 0 00-2 2v12a2 2 0 002 2h16a2 2 0 002-2V6a2 2 0 00-2-2z">
                                        </path>
                                    </svg>
                                </div>
                            @endif
                        </td>
                        {{-- AKHIR BLOK GAMBAR --}}
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $product->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">Rp {{ number_format($product->price, 0, ',', '.') }}
                        </td>
                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm @if ($product->stock > 10) text-green-600 @else text-red-600 @endif">
                            {{ $product->stock }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">

                            <a href="{{ route('umkm.products.edit', $product) }}"
                                class="text-indigo-600 hover:text-indigo-900">
                                Edit
                            </a>

                            <form action="{{ route('umkm.products.destroy', $product) }}" method="POST" class="inline"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini? Tindakan ini tidak dapat dibatalkan.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 ml-2">
                                    Hapus
                                </button>
                            </form>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-6 text-center text-gray-500">
                            Anda belum memiliki produk yang terdaftar.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    @endsection
