@extends('layouts.admin_dashboard_layout')

@section('title', 'Detail Pesanan #' . $order->id)

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.orders.index') }}" class="text-red-600 hover:text-red-800 flex items-center mb-4">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Daftar Pesanan
        </a>
        <h1 class="text-3xl font-bold text-gray-800">Detail Pesanan #{{ $order->id }}</h1>
        <p class="text-sm text-gray-500">Dipesan oleh {{ $order->user->name }} pada
            {{ $order->created_at->format('d M Y, H:i') }}</p>
    </div>

    {{-- KARTU RINGKASAN --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        {{-- Total Harga --}}
        <div class="bg-blue-50 p-4 rounded-lg shadow-sm">
            <p class="text-sm font-medium text-gray-600">Total Pembayaran</p>
            <p class="text-2xl font-bold text-blue-700">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
        </div>
        {{-- Status --}}
        <div class="bg-yellow-50 p-4 rounded-lg shadow-sm">
            <p class="text-sm font-medium text-gray-600">Status</p>
            <span
                class="px-3 py-1 inline-flex text-lg leading-5 font-semibold rounded-full 
                @if ($order->status == 'delivered') bg-green-200 text-green-800
                @elseif($order->status == 'pending_payment') bg-yellow-200 text-yellow-800
                @else bg-blue-200 text-blue-800 @endif">
                {{ ucfirst(str_replace('_', ' ', $order->status)) }}
            </span>
        </div>
        {{-- Detail Pemesan --}}
        <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
            <p class="text-sm font-medium text-gray-600">Pemesan</p>
            <p class="font-bold text-gray-800">{{ $order->user->name }}</p>
            <p class="text-sm text-gray-600">{{ $order->user->email }}</p>
        </div>
    </div>

    {{-- DAFTAR ITEM PESANAN --}}
    <h2 class="text-2xl font-bold text-gray-800 mb-4 border-b pb-2">Item Pesanan</h2>
    <div class="space-y-4">
        @foreach ($order->items as $item)
            <div class="flex items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm">
                <div class="flex items-center space-x-4">
                    {{-- Detail Produk --}}
                    <div>
                        <p class="font-semibold text-gray-900">{{ $item->product->name }} (x{{ $item->quantity }})</p>
                        <p class="text-sm text-gray-500">Rp {{ number_format($item->price, 0, ',', '.') }} per unit</p>
                        <p class="text-xs text-gray-600 mt-1">
                            **Dijual oleh:** <span class="font-medium text-gray-700">
                                {{-- Jika umkmProfile null, tampilkan teks pengganti 'UMKM Tidak Ditemukan' --}}
                                {{ $item->umkmProfile?->name ?? 'UMKM Tidak Ditemukan (Data Hilang)' }}
                            </span>
                        </p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="font-bold text-lg text-red-600">Total: Rp
                        {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection
