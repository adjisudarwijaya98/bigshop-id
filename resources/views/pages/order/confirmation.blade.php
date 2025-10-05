@extends('layouts.main')

@section('title', 'Pesanan Dibuat - Bigshop.Id')

@section('content')
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="max-w-3xl mx-auto bg-white p-10 rounded-lg shadow-2xl text-center">

                <svg class="w-16 h-16 mx-auto text-green-500 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>

                <h1 class="text-4xl font-extrabold text-gray-800 mb-4">Pesanan Berhasil Dibuat!</h1>
                <p class="text-xl text-gray-600 mb-8">Terima kasih telah berbelanja produk UMKM di Bigshop.Id. Pesanan Anda
                    kini sedang menunggu pembayaran.</p>

                <div class="bg-red-50 p-6 rounded-lg mb-8 border border-red-200">
                    <p class="text-xl font-semibold text-gray-700">Nomor Pesanan Anda:</p>
                    <p class="text-4xl font-bold text-red-600 mt-2">#{{ $order->id }}</p>
                </div>

                <div class="mb-8">
                    <p class="text-lg font-semibold text-gray-700">Total Pembayaran:</p>
                    <p class="text-3xl font-bold text-green-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </p>
                    <div class="mt-6 p-4 bg-gray-100 rounded-lg border border-gray-300">
                        <p class="text-lg font-bold text-gray-800 mb-2">Lakukan Transfer ke:</p>
                        <p class="text-xl font-extrabold text-blue-800">Bank Central Asia (BCA)</p>
                        <p class="text-2xl font-extrabold text-red-600">No. Rek: 1234 5678 90</p>
                        <p class="text-lg text-gray-600">a.n. PT. Bigshop Indonesia</p>
                        <p class="text-sm text-gray-500 mt-3">Mohon transfer dengan jumlah yang akurat untuk memudahkan
                            verifikasi.</p>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row justify-center space-y-4 md:space-y-0 md:space-x-4">
                    <a href="{{ url('/') }}"
                        class="bg-red-600 text-white font-bold py-3 px-8 rounded-lg hover:bg-red-700 transition duration-300">
                        Kembali ke Halaman Utama
                    </a>
                    {{-- Di sini nanti bisa ditambahkan link ke Halaman Riwayat Pesanan --}}
                </div>
            </div>
        </div>
    </section>
@endsection
