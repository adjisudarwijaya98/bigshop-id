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
        {{-- Tombol untuk menambah produk baru (akan kita fungsikan nanti) --}}
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
                @foreach ($products as $product)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}"
                                class="h-10 w-10 rounded object-cover">
                        </td>
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
                @endforeach
            </tbody>
        </table>

        {{-- Tampil jika tidak ada produk --}}
        @if ($products->isEmpty())
            <p class="p-6 text-center text-gray-500">Anda belum memiliki produk yang terdaftar.</p>
        @endif
    </div>
@endsection
