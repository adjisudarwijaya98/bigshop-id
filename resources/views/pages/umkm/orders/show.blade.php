@extends('layouts.dashboard_layout')

@section('title', 'Detail Pesanan #' . $orderItem->order->id . ' - Bigshop.Id')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Detail Pesanan #{{ $orderItem->order->id }}</h1>
        <p class="text-gray-600">Informasi lengkap item pesanan Anda.</p>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="lg:col-span-2 space-y-6">

            <div class="bg-white p-6 rounded-lg shadow-xl">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Produk Dipesan</h2>
                <div class="flex items-center">
                    <img src="{{ asset('storage/' . $orderItem->product->image_url) }}" alt="{{ $orderItem->product_name }}"
                        class="w-20 h-20 object-cover rounded-lg mr-4 border">
                    <div>
                        <p class="text-lg font-bold text-gray-800">{{ $orderItem->product_name }}</p>
                        <p class="text-sm text-gray-500">{{ $orderItem->quantity }} Unit x Rp
                            {{ number_format($orderItem->price, 0, ',', '.') }}</p>
                        <p class="text-xl font-extrabold text-red-600 mt-2">Subtotal: Rp
                            {{ number_format($orderItem->price * $orderItem->quantity, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-xl">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Status Pesanan Induk</h2>
                <div class="mb-4">
                    <p class="text-lg font-medium text-gray-700">Status Saat Ini:</p>
                    <span
                        class="px-4 py-2 inline-flex text-xl leading-5 font-bold rounded-full @if ($orderItem->order->status == 'pending_payment') bg-yellow-100 text-yellow-800 @elseif($orderItem->order->status == 'completed') bg-green-100 text-green-800 @else bg-blue-100 text-blue-800 @endif">
                        {{ Str::replace('_', ' ', Str::title($orderItem->order->status)) }}
                    </span>
                </div>

                <h3 class="text-lg font-semibold text-gray-800 mt-6 mb-3">Ubah Status</h3>
                <form action="{{ route('umkm.orders.update_status', $orderItem) }}" method="POST"
                    class="flex space-x-4 items-center">
                    @csrf
                    <select name="status" required class="border border-gray-300 rounded-lg p-2">
                        <option value="pending_payment" @selected($orderItem->order->status == 'pending_payment')>0. Menunggu Pembayaran</option>
                        <option value="processing" @selected($orderItem->order->status == 'processing')>1. Proses Penyiapan Barang</option>
                        <option value="shipped" @selected($orderItem->order->status == 'shipped')>2. Barang Dikirim</option>
                        <option value="delivered" @selected($orderItem->order->status == 'delivered')>3. Selesai (Diterima)</option>
                        <option value="cancelled" @selected($orderItem->order->status == 'cancelled')>9. Dibatalkan</option>
                    </select>
                    <button type="submit"
                        class="bg-red-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-red-700 transition duration-300">
                        Update Status
                    </button>
                </form>
            </div>
        </div>

        <div class="lg:col-span-1 bg-white p-6 rounded-lg shadow-xl h-fit">
            <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Alamat Pengiriman</h2>
            <p class="font-bold text-gray-700">{{ $orderItem->order->receiver_name }}</p>
            <p class="text-sm text-gray-500 mb-4">Telp: {{ $orderItem->order->receiver_phone }}</p>

            <address class="not-italic text-gray-600">
                {{ $orderItem->order->shipping_address }},<br>
                {{ $orderItem->order->shipping_city }}<br>
                Kode Pos: {{ $orderItem->order->shipping_postal_code }}
            </address>

            <h2 class="text-xl font-semibold text-gray-800 mt-6 mb-4 border-b pb-2">Total & Pembayaran</h2>
            <div class="flex justify-between font-bold text-lg">
                <span>Total Bayar:</span>
                <span class="text-red-600">Rp {{ number_format($orderItem->order->total_price, 0, ',', '.') }}</span>
            </div>
            <p class="text-sm text-gray-500 mt-2">Metode: Transfer Bank Manual</p>
        </div>

    </div>
@endsection
