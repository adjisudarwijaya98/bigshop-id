@extends('layouts.main')

@section('title', 'Detail Pesanan #' . $order->id)

@section('content')
    <section class="py-12 md:py-20 bg-gray-50 min-h-screen">
        <div class="container mx-auto px-6 max-w-5xl">
            <a href="{{ route('user.orders.history') }}" class="text-red-600 mb-6 inline-block hover:underline">&larr; Kembali
                ke Riwayat Pesanan</a>

            <h1 class="text-3xl font-bold text-gray-800 mb-2">Detail Pesanan #{{ $order->id }}</h1>
            <p class="text-lg text-gray-600 mb-8">Tanggal: {{ $order->created_at->format('d M Y, H:i') }}</p>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-1 bg-white p-6 rounded-lg shadow-md h-fit">
                    <h2 class="text-xl font-semibold text-gray-800 border-b pb-2 mb-4">Alamat Pengiriman</h2>
                    <p class="font-bold text-gray-700">{{ $order->receiver_name }} ({{ $order->receiver_phone }})</p>
                    <p class="text-gray-600 mt-2">{{ $order->shipping_address }}</p>
                    <p class="text-gray-600">{{ $order->shipping_city }}, {{ $order->shipping_postal_code }}</p>
                </div>

                <div class="lg:col-span-2">
                    <div class="bg-red-50 p-6 rounded-lg shadow-md border border-red-200 mb-6">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm font-medium text-gray-700">Status Pesanan:</p>
                                <span
                                    class="px-3 py-1 text-lg font-bold rounded-full @if ($order->status == 'pending_payment') bg-yellow-100 text-yellow-800 @elseif($order->status == 'completed') bg-green-100 text-green-800 @else bg-blue-100 text-blue-800 @endif">
                                    {{ Str::replace('_', ' ', Str::title($order->status)) }}
                                </span>
                            </div>
                            <div class="text-right">
                                <p class="text-xl font-bold text-gray-700">Total Pembayaran:</p>
                                <p class="text-4xl font-extrabold text-red-600">Rp
                                    {{ number_format($order->total_price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>

                    <h2 class="text-xl font-semibold text-gray-800 border-b pb-2 mb-4">Item Dipesan
                        ({{ $order->items->count() }} Produk)</h2>
                    <div class="space-y-4">
                        @foreach ($order->items as $item)
                            <div class="flex items-center bg-white p-4 rounded-lg shadow-sm border">
                                {{-- Kita asumsikan product masih ada, jika null, fallback ke placeholder --}}
                                <img src="{{ asset('storage/' . $item->product->image_url ?? 'path/to/default/image.jpg') }}"
                                    alt="{{ $item->product_name }}" class="w-16 h-16 object-cover rounded-md mr-4">

                                <div class="flex-1">
                                    <p class="text-lg font-semibold text-gray-800">{{ $item->product_name }}</p>
                                    <p class="text-sm text-gray-500">Dari Toko ID: {{ $item->umkm_id }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-gray-700">{{ $item->quantity }} x Rp
                                        {{ number_format($item->price, 0, ',', '.') }}</p>
                                    <p class="text-lg font-bold text-red-600">Rp
                                        {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
