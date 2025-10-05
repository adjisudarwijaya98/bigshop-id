@extends('layouts.main')

@section('title', $product->name . ' - Bigshop.Id')

@section('content')
    <section class="py-12 md:py-20">
        <div class="container mx-auto px-6">

            <div class="md:flex md:space-x-12 bg-white p-8 rounded-lg shadow-lg">

                <div class="md:w-1/2 mb-6 md:mb-0">
                    <img class="w-full h-auto object-cover rounded-lg shadow-md"
                        src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}">
                </div>

                <div class="md:w-1/2">
                    <h1 class="text-3xl md:text-4xl font-extrabold text-gray-800 mb-2">{{ $product->name }}</h1>

                    <p class="text-4xl font-bold text-red-600 mb-6">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>

                    <div class="flex items-center space-x-4 mb-8">
                        <span class="text-lg font-semibold text-gray-700">Stok:</span>
                        <span
                            class="text-lg font-bold @if ($product->stock > 0) text-green-600 @else text-red-600 @endif">
                            @if ($product->stock > 0)
                                {{ $product->stock }} tersedia
                            @else
                                Stok Habis
                            @endif
                        </span>
                    </div>

                    <div class="space-y-4">

                        {{-- Form Tambahkan ke Keranjang --}}
                        <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-8">
                            @csrf

                            {{-- Input Jumlah --}}
                            <div class="flex items-center space-x-4 mb-6">
                                <label for="quantity" class="text-lg font-semibold text-gray-700">Jumlah:</label>
                                <input type="number" name="quantity" id="quantity" value="1" min="1"
                                    max="{{ $product->stock }}" required
                                    class="w-20 border border-gray-300 rounded-lg p-2 text-center focus:ring-red-500 focus:border-red-500">
                            </div>

                            {{-- Tombol Utama (Tambahkan ke Keranjang) --}}
                            @if ($product->stock > 0)
                                <button type="submit"
                                    class="w-full bg-red-600 text-white text-xl font-bold py-3 px-8 rounded-full shadow-lg hover:bg-red-700 transition duration-300">
                                    Tambahkan ke Keranjang
                                </button>
                            @else
                                <p class="text-red-500 font-semibold text-xl">Stok Habis</p>
                            @endif
                        </form>

                        {{-- Tombol Sekunder (Beli Sekarang) --}}
                        <button
                            class="w-full bg-gray-200 text-gray-800 font-bold py-3 px-6 rounded-lg text-lg hover:bg-gray-300 transition duration-300">
                            Beli Sekarang
                        </button>


                        {{-- Tampilkan Pesan Sukses jika ada --}}
                        @if (session('success'))
                            <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                                role="alert">
                                <span class="block sm:inline">{{ session('success') }}</span>
                            </div>
                        @endif

                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Informasi Toko</h3>
                        {{-- Data UMKM ini masih hardcode karena relasi belum sempurna, tapi akan bekerja! --}}
                        <p class="text-lg text-gray-600">Nama Toko: **Toko Laris Manis**</p>
                        <p class="text-lg text-gray-600">Lokasi: **Bandung**</p>
                    </div>
                </div>
            </div>

            <div class="mt-12 p-8 bg-white rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold text-gray-800 mb-4 border-b pb-2">Deskripsi Produk</h2>
                <p class="text-gray-600 leading-relaxed whitespace-pre-wrap">{{ $product->description }}</p>
            </div>

            <div class="mt-10 text-center">
                <a href="/marketplace" class="text-red-600 hover:text-red-700 font-semibold inline-flex items-center">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Marketplace
                </a>
            </div>

        </div>
    </section>
@endsection
