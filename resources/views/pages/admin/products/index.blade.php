@extends('layouts.admin_dashboard_layout')

@section('title', 'Manajemen Semua Produk')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Manajemen Produk (Moderasi)</h1>

    {{-- Tampilkan notifikasi jika ada --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white p-6 rounded-lg shadow-md border overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Produk
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Toko UMKM</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($products as $product)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $product->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $product->name }}</td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            {{-- Menggunakan Nullsafe Operator (?->) untuk mencegah error jika umkmProfile null --}}
                            {{ $product->umkmProfile?->store_name ?? 'UMKM TIDAK DITEMUKAN' }}<br>

                            <span class="text-xs text-gray-500">
                                ({{ $product->umkmProfile?->user?->name ?? 'Pemilik Tidak Diketahui' }})
                            </span>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            Rp{{ number_format($product->price, 0, ',', '.') }}</td>

                        {{-- Status Published --}}
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($product->is_published)
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Tayang</span>
                            @else
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Draf/Hidden</span>
                            @endif
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            {{-- Tombol Detail/Edit (Opsional, untuk nanti) --}}
                            <a href="#" class="text-red-600 hover:text-red-900 mr-3">Detail</a>

                            {{-- Form Delete Sederhana --}}
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                class="inline ml-2"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk {{ $product->name }}? Aksi ini tidak dapat dibatalkan.');">
                                @csrf
                                @method('DELETE') {{-- Wajib untuk route DELETE --}}
                                <button type="submit" class="text-gray-500 hover:text-red-700 focus:outline-none">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>
@endsection
