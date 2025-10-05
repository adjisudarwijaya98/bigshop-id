@extends('layouts.main')

@section('title', 'Checkout - Konfirmasi Pembayaran')

@section('content')
    <section class="py-12 md:py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-8 border-b pb-4">Konfirmasi Checkout</h1>

            <div class="lg:flex lg:space-x-8">

                <div class="lg:w-2/3 bg-white p-8 rounded-lg shadow-xl mb-8 lg:mb-0">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b pb-2">1. Detail Pengiriman</h2>

                    <form action="{{ route('checkout.store') }}" method="POST">
                        @csrf

                        @if (session('error'))
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                                {{ session('error') }}</div>
                        @endif

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div>
                                <label for="receiver_name" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                    Penerima</label>
                                <input type="text" name="receiver_name" id="receiver_name" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-red-500 focus:border-red-500"
                                    value="{{ old('receiver_name', $user->name) }}">
                                @error('receiver_name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="receiver_phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor
                                    Telepon</label>
                                <input type="text" name="receiver_phone" id="receiver_phone" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-red-500 focus:border-red-500"
                                    value="{{ old('receiver_phone', optional($user->umkmProfile)->phone ?? '') }}">
                                @error('receiver_phone')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="shipping_city" class="block text-sm font-medium text-gray-700 mb-1">Kota</label>
                                <input type="text" name="shipping_city" id="shipping_city" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-red-500 focus:border-red-500"
                                    value="{{ old('shipping_city') }}">
                                @error('shipping_city')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="shipping_postal_code" class="block text-sm font-medium text-gray-700 mb-1">Kode
                                    Pos</label>
                                <input type="text" name="shipping_postal_code" id="shipping_postal_code" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-red-500 focus:border-red-500"
                                    value="{{ old('shipping_postal_code') }}">
                                @error('shipping_postal_code')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="shipping_address" class="block text-sm font-medium text-gray-700 mb-1">Alamat
                                    Lengkap</label>
                                <textarea name="shipping_address" id="shipping_address" rows="3" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-red-500 focus:border-red-500">{{ old('shipping_address', optional($user->umkmProfile)->address ?? '') }}</textarea>
                                @error('shipping_address')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        <h2 class="text-2xl font-semibold text-gray-800 mt-10 mb-6 border-b pb-2">2. Metode Pembayaran</h2>
                        <div class="space-y-4">
                            <div class="p-4 border border-gray-300 rounded-lg bg-gray-50">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="payment_method" value="bank_transfer" checked
                                        class="form-radio text-red-600 h-4 w-4">
                                    <span class="ml-2 text-lg font-medium text-gray-700">Transfer Bank Manual</span>
                                </label>
                                <p class="text-sm text-gray-500 ml-6">Anda akan mendapatkan detail rekening setelah pesanan
                                    dikonfirmasi.</p>
                            </div>

                            {{-- Kita bisa tambahkan COD di sini nanti --}}
                        </div>

                        <div class="mt-8">
                            <button type="submit"
                                class="w-full bg-green-600 text-white font-bold py-3 rounded-lg text-xl hover:bg-green-700 transition duration-300 shadow-lg">
                                Konfirmasi Pesanan & Bayar (Rp {{ number_format($totalPrice, 0, ',', '.') }})
                            </button>
                        </div>
                    </form>
                </div>

                <div class="lg:w-1/3">
                    <div class="bg-white p-6 rounded-lg shadow-xl sticky top-20">
                        <h2 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">Ringkasan Pesanan</h2>

                        <div class="space-y-4 max-h-96 overflow-y-auto pr-2">
                            @foreach ($cart as $item)
                                <div class="flex items-center justify-between border-b pb-2">
                                    <div class="flex items-center">
                                        <img src="{{ asset('storage/' . $item['image_url']) }}" alt="{{ $item['name'] }}"
                                            class="w-10 h-10 object-cover rounded mr-3">
                                        <div>
                                            <p class="text-sm font-semibold text-gray-800">{{ $item['name'] }}</p>
                                            <p class="text-xs text-gray-500">{{ $item['quantity'] }} x Rp
                                                {{ number_format($item['price'], 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                    <span class="text-sm font-semibold text-gray-700">Rp
                                        {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="flex justify-between text-2xl font-bold text-gray-800 mt-4 pt-4 border-t">
                            <span>Total Bayar:</span>
                            <span class="text-red-600">Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
