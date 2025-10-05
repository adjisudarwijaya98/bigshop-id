@extends('layouts.main')

@section('title', 'Keranjang Belanja - Bigshop.Id')

@section('content')
    <section class="py-12 md:py-20">
        <div class="container mx-auto px-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-8 border-b pb-4">Keranjang Belanja Anda</h1>
            {{-- Alert Error --}}
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            {{-- Alert Success --}}
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @php $totalPrice = 0; @endphp

            @if (!empty($cart))
                <div class="lg:flex lg:space-x-8">

                    <div class="lg:w-3/4 space-y-6">
                        @foreach ($cart as $id => $details)
                            @php
                                $subtotal = $details['price'] * $details['quantity'];
                                $totalPrice += $subtotal;
                            @endphp

                            <div
                                class="flex items-center bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                                <img src="{{ asset('storage/' . $details['image_url']) }}" alt="{{ $details['name'] }}"
                                    class="w-20 h-20 object-cover rounded-md mr-6">

                                <div class="flex-1 min-w-0">
                                    <h2 class="text-lg font-semibold text-gray-800 truncate">{{ $details['name'] }}</h2>
                                    <p class="text-sm text-gray-500">Harga Satuan: Rp
                                        {{ number_format($details['price'], 0, ',', '.') }}</p>
                                    <p class="text-md font-bold text-red-600 mt-1">Subtotal: Rp
                                        {{ number_format($subtotal, 0, ',', '.') }}</p>
                                </div>

                                <div class="flex items-center space-x-4">
                                    {{-- Form Update Kuantitas (Akan diimplementasikan nanti) --}}
                                    <input type="number" value="{{ $details['quantity'] }}" min="1" disabled
                                        class="w-16 border border-gray-300 rounded-lg p-2 text-center">

                                    <div class="flex items-center space-x-4">

                                        {{-- Form Remove Item --}}
                                        <form action="{{ route('cart.remove', ['product' => $id]) }}" method="POST"
                                            onsubmit="return confirm('Hapus item ini dari keranjang?');">
                                            @csrf
                                            <button type="submit"
                                                class="text-red-500 hover:text-red-700 p-2 rounded-full hover:bg-red-50 transition duration-200">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="lg:w-1/4 mt-8 lg:mt-0 bg-white p-6 rounded-lg shadow-xl sticky top-20 h-fit">
                        <h2 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">Ringkasan Belanja</h2>

                        <div class="flex justify-between text-lg text-gray-600 mb-2">
                            <span>Total Item:</span>
                            <span class="font-semibold">{{ count($cart) }}</span>
                        </div>

                        <div class="flex justify-between text-2xl font-bold text-gray-800 mt-4 pt-4 border-t">
                            <span>Total Harga:</span>
                            <span class="text-red-600">Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                        </div>

                        <a href="{{ url('/checkout') }}"
                            class="mt-6 block text-center bg-red-600 text-white font-bold py-3 rounded-lg hover:bg-red-700 transition duration-300">
                            Lanjutkan ke Pembayaran (Checkout)
                        </a>

                        <a href="{{ route('marketplace') }}"
                            class="mt-3 block text-center text-red-600 font-semibold hover:underline">
                            Lanjut Belanja
                        </a>
                    </div>
                </div>
            @else
                <div class="bg-white p-12 text-center rounded-lg shadow-xl">
                    <svg class="w-20 h-20 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                    <p class="text-xl text-gray-600 font-semibold">Keranjang belanja Anda masih kosong.</p>
                    <p class="text-gray-500 mt-2">Yuk, cari produk UMKM favorit Anda!</p>
                    <a href="{{ route('marketplace') }}"
                        class="mt-6 inline-block bg-red-600 text-white font-bold py-3 px-8 rounded-full hover:bg-red-700 transition duration-300">
                        Mulai Belanja Sekarang
                    </a>
                </div>
            @endif
        </div>
    </section>
@endsection
