@extends('layouts.main')

@section('title', 'Riwayat Pesanan')

@section('content')
    <section class="py-12 md:py-20 bg-gray-50 min-h-screen">
        <div class="container mx-auto px-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-8 border-b pb-4">Riwayat Pesanan Anda</h1>

            @if ($orders->isEmpty())
                <div class="text-center p-10 bg-white rounded-lg shadow-md">
                    <p class="text-xl text-gray-600">Anda belum memiliki riwayat pesanan.</p>
                    <a href="{{ route('marketplace') }}" class="mt-4 inline-block text-red-600 hover:underline">Mulai
                        Belanja</a>
                </div>
            @else
                <div class="space-y-6">
                    @foreach ($orders as $order)
                        <div
                            class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition duration-300 border-l-4 @if ($order->status == 'pending_payment') border-yellow-500 @elseif($order->status == 'completed') border-green-500 @else border-blue-500 @endif">
                            <div class="flex justify-between items-center border-b pb-3 mb-3">
                                <div>
                                    <p class="text-sm text-gray-500">Tanggal Pesan:</p>
                                    <p class="text-md font-semibold">{{ $order->created_at->format('d M Y, H:i') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Status:</p>
                                    <span
                                        class="px-3 py-1 text-sm font-semibold rounded-full @if ($order->status == 'pending_payment') bg-yellow-100 text-yellow-800 @elseif($order->status == 'completed') bg-green-100 text-green-800 @else bg-blue-100 text-blue-800 @endif">
                                        {{ Str::replace('_', ' ', Str::title($order->status)) }}
                                    </span>
                                </div>
                            </div>

                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-lg font-semibold text-gray-700">Order ID: #{{ $order->id }}</p>
                                    <p class="text-sm text-gray-500">{{ $order->items->count() }} jenis produk</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-lg font-bold text-red-600">Total: Rp
                                        {{ number_format($order->total_price, 0, ',', '.') }}</p>
                                    <a href="{{ route('user.orders.show', $order) }}"
                                        class="text-sm text-indigo-600 hover:underline mt-1 inline-block">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
