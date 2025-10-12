@extends('layouts.main')

@section('title', 'Bigshop.Id - Marketplace & E-learning UMKM Lokal')

@section('content')

    {{-- Container Wrapper --}}
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 pt-6 pb-16">

        {{-- ======================================================================= --}}
        {{-- BAGIAN 1: CAROUSEL PROMO (Menggunakan Alpine.js untuk Auto-slide & Navigasi) --}}
        {{-- ======================================================================= --}}
        <section class="relative w-full mb-12">
            <div x-data="{
                currentSlide: 0,
                totalSlides: {{ count($carousels) }},
                init() {
                    // Auto-slide every 5 seconds
                    setInterval(() => {
                        this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
                    }, 5000);
                }
            }" class="relative w-full overflow-hidden rounded-xl shadow-lg border border-gray-100">

                {{-- SLIDES CONTAINER --}}
                <div class="flex transition-transform duration-700 ease-in-out"
                    :style="`transform: translateX(-${currentSlide * 100}%)`">

                    @foreach ($carousels as $index => $carousel)
                        <div class="w-full flex-shrink-0 relative h-72 md:h-96 xl:h-[420px]">

                            {{-- Image Path: Assuming image_url contains the path relative to the public/uploads folder --}}
                            <img src="{{ asset('uploads/' . $carousel->image_url) }}" alt="{{ $carousel->title }}"
                                class="absolute inset-0 w-full h-full object-cover" loading="lazy">

                            {{-- OVERLAY for Text and Button --}}
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent flex items-end justify-start p-6 md:p-12">
                                <div class="max-w-3xl text-white text-left">
                                    {{-- Judul dan Subjudul --}}
                                    <h2
                                        class="text-2xl md:text-4xl lg:text-5xl font-extrabold mb-2 leading-tight drop-shadow-lg">
                                        {{ $carousel->title }}
                                    </h2>
                                    <p class="text-base md:text-xl lg:text-xl mb-6 font-light drop-shadow">
                                        {{ $carousel->subtitle }}
                                    </p>

                                    {{-- Tombol --}}
                                    <a href="{{ $carousel->button_link }}"
                                        class="inline-block px-6 py-3 bg-red-600 text-white text-lg font-semibold rounded-full hover:bg-red-700 transition duration-300 transform hover:scale-[1.02] shadow-xl">
                                        {{ $carousel->button_text }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- KONTROL: Dot Navigasi di bawah --}}
                <div class="absolute inset-x-0 bottom-4 flex justify-center space-x-2 z-20">
                    @foreach ($carousels as $index => $carousel)
                        <button @click="currentSlide = {{ $index }}"
                            :class="{
                                'bg-red-600 scale-110': currentSlide === {{ $index }},
                                'bg-white opacity-60': currentSlide !== {{ $index }}
                            }"
                            class="w-3 h-3 rounded-full transition-all duration-300 shadow"></button>
                    @endforeach
                </div>

                {{-- KONTROL: Tombol Previous/Next --}}
                <button @click="currentSlide = (currentSlide - 1 + totalSlides) % totalSlides"
                    class="absolute top-1/2 left-4 -translate-y-1/2 bg-black/30 p-3 rounded-full text-white hover:bg-black/60 transition duration-300 focus:outline-none hidden md:block z-10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <button @click="currentSlide = (currentSlide + 1) % totalSlides"
                    class="absolute top-1/2 right-4 -translate-y-1/2 bg-black/30 p-3 rounded-full text-white hover:bg-black/60 transition duration-300 focus:outline-none hidden md:block z-10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>
        </section>


        {{-- ======================================================================= --}}
        {{-- BAGIAN 2: PRODUK UNGGULAN UMKM --}}
        {{-- ======================================================================= --}}
        <section class="py-12">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 text-center mb-10">
                Produk Unggulan Pilihan UMKM
            </h2>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 md:gap-6">
                @foreach ($products as $product)
                    <div
                        class="bg-white rounded-xl border border-gray-200 overflow-hidden transform hover:shadow-xl hover:border-red-300 transition-all duration-300">

                        {{-- LOGIKA PATH GAMBAR DIVERSIFIKASI DAN DIRAPIKAN --}}
                        @php
                            // Jika image_url sudah dimulai dengan 'storage/', gunakan apa adanya.
                            // Jika belum, tambahkan 'storage/' (asumsi path default Laravel storage symlink).
                            $finalPath = str_starts_with($product->image_url, 'storage/')
                                ? $product->image_url
                                : 'storage/' . $product->image_url;
                        @endphp

                        <img class="w-full h-36 sm:h-48 object-cover" src="{{ asset($finalPath) }}"
                            alt="{{ $product->name }}" loading="lazy">

                        <div class="p-3 md:p-4">
                            <h3 class="text-base font-semibold mb-1 truncate text-gray-900">{{ $product->name }}</h3>

                            <p class="text-red-600 mb-2 font-bold text-lg">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </p>

                            <p class="text-xs text-gray-500 mb-3 line-clamp-1">
                                Toko: {{ $product->umkm->name ?? 'UMKM Tidak Ditemukan' }}
                            </p>

                            <a href="/product/{{ $product->slug }}"
                                class="mt-2 block w-full bg-red-600 text-white text-center font-medium text-sm py-2 rounded-lg hover:bg-red-700 transition duration-300 shadow-md">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-12">
                <a href="/marketplace"
                    class="text-lg font-bold text-red-600 hover:text-red-800 transition duration-300 flex items-center justify-center space-x-2 p-3 border border-red-600 rounded-full hover:bg-red-50">
                    <span>Lihat Semua Produk di Marketplace</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3">
                        </path>
                    </svg>
                </a>
            </div>

        </section>


        {{-- ======================================================================= --}}
        {{-- BAGIAN 3: LOGO PARTNER/MITRA --}}
        {{-- ======================================================================= --}}
        <section class="py-12 bg-white rounded-xl shadow-inner mt-8">
            <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 text-center mb-10 leading-snug">
                Didukung oleh <span class="text-red-600">Mitra Bisnis Terpercaya</span>
            </h2>

            {{-- Grid Logo Partner --}}
            <div
                class="grid grid-cols-4 sm:grid-cols-5 lg:grid-cols-7 gap-4 md:gap-8 justify-items-center items-center px-4">

                @for ($i = 1; $i <= 11; $i++)
                    <img src="{{ asset("assets/img/partners/{$i}.png") }}" alt="Logo Partner {{ $i }}"
                        class="h-16 sm:h-20 w-auto object-contain opacity-70 hover:opacity-100 transition duration-300 transform hover:scale-105">
                @endfor

            </div>
            <p class="text-center text-gray-500 text-sm mt-8 px-4">
                Kami bangga bekerja sama dengan berbagai organisasi untuk memberdayakan UMKM di seluruh Indonesia.
            </p>
        </section>

    </div>
@endsection
