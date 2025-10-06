@extends('layouts.main')

@section('title', 'Bigshop.Id - Marketplace & E-learning UMKM Lokal')

@section('content')

    {{-- BAGIAN 1: CAROUSEL --}}
    <section class="relative w-full overflow-hidden">
        {{-- Menggunakan x-data untuk Alpine.js --}}
        <div x-data="{
            currentSlide: 0,
            totalSlides: {{ count($carousels) }},
            init() {
                // Auto-slide setiap 5 detik
                setInterval(() => {
                    this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
                }, 5000);
            }
        }" class="relative w-full overflow-hidden rounded-xl shadow-2xl">

            {{-- SLIDES CONTAINER --}}
            <div class="flex transition-transform duration-700 ease-in-out"
                :style="`transform: translateX(-${currentSlide * 100}%)`">

                @foreach ($carousels as $index => $carousel)
                    <div class="w-full flex-shrink-0 relative h-[300px] md:h-[650px] lg:h-[420px]">

                        {{-- PERBAIKAN PATH IMAGE CAROUSEL --}}
                        @php
                            $imagePath = $carousel->image_url;
                            $cleanPath = ltrim($imagePath, '/');

                            if (!str_starts_with($cleanPath, 'uploads/')) {
                                $finalPath = 'uploads/' . $cleanPath;
                            } else {
                                $finalPath = $cleanPath;
                            }
                        @endphp

                        <img src="{{ asset($finalPath) }}" alt="{{ $carousel->title }}"
                            class="absolute inset-0 w-full h-full object-cover">

                        {{-- OVERLAY untuk teks --}}
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent flex items-end justify-start p-8 md:p-16">
                            <div class="max-w-3xl text-white text-left">
                                {{-- Judul dan Subjudul --}}
                                <h2
                                    class="text-2xl md:text-4xl lg:text-5xl font-extrabold mb-2 leading-tight drop-shadow-xl">
                                    {{ $carousel->title }}
                                </h2>
                                <p class="text-base md:text-xl lg:text-xl mb-6 font-light drop-shadow-lg">
                                    {{ $carousel->subtitle }}
                                </p>

                                {{-- Tombol --}}
                                <a href="{{ $carousel->button_link }}"
                                    class="inline-block px-6 py-3 bg-red-600 text-white text-lg font-semibold rounded-full hover:bg-red-700 transition duration-300 transform hover:scale-105 shadow-xl">
                                    {{ $carousel->button_text }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- KONTROL: Dot Navigasi di bawah (Sudah menggunakan @click Alpine.js) --}}
            <div class="absolute inset-x-0 bottom-4 flex justify-center space-x-2">
                @foreach ($carousels as $index => $carousel)
                    <button @click="currentSlide = {{ $index }}"
                        :class="{
                            'bg-red-600 scale-110': currentSlide ===
                                {{ $index }},
                            'bg-white opacity-50': currentSlide !== {{ $index }}
                        }"
                        class="w-3 h-3 rounded-full transition-all duration-300"></button>
                @endforeach
            </div>

            {{-- KONTROL: Tombol Previous/Next (Sudah menggunakan @click Alpine.js) --}}
            <button @click="currentSlide = (currentSlide - 1 + totalSlides) % totalSlides"
                class="absolute top-1/2 left-4 -translate-y-1/2 bg-white/30 p-3 rounded-full text-white hover:bg-white/50 transition duration-300 focus:outline-none hidden md:block">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            <button @click="currentSlide = (currentSlide + 1) % totalSlides"
                class="absolute top-1/2 right-4 -translate-y-1/2 bg-white/30 p-3 rounded-full text-white hover:bg-white/50 transition duration-300 focus:outline-none hidden md:block">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>

    </section>

    {{-- BAGIAN 2: PRODUK UNGGULAN UMKM --}}

    <section class="py-16">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 text-center mb-12">
                Produk Unggulan Pilihan UMKM
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach ($featuredProducts as $product)
                    <div
                        class="bg-white rounded-lg shadow-xl overflow-hidden transform hover:scale-105 transition-transform duration-300">

                        {{-- PERBAIKAN PATH IMAGE PRODUK UNGGULAN (TANPA STORAGE LINK) --}}
                        @php
                            // 1. Ambil nama file saja dari URL yang tersimpan di database.
                            // Contoh: Jika image_url berisi 'uploads/fileku.jpg', basename akan menghasilkan 'fileku.jpg'.
                            // Ini menghindari masalah jika ada prefix 'storage/' atau path lain yang ikut tersimpan.
                            $filename = basename($product->image_url);

                            // 2. Gabungkan dengan 'uploads/' secara eksplisit.
                            // Karena file sudah dipindahkan ke folder public/uploads,
                            // fungsi asset() akan menghasilkan URL yang benar: http://.../uploads/fileku.jpg
                            $finalPath = 'uploads/' . $filename;
                        @endphp

                        <img class="w-full h-48 object-cover" src="{{ asset($finalPath) }}" alt="{{ $product->name }}">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold mb-1 truncate">{{ $product->name }}</h3>
                            <p class="text-gray-600 mb-4 font-bold text-xl">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </p>
                            <a href="/product/{{ $product->slug }}"
                                class="block w-full bg-red-600 text-white text-center font-semibold py-2 rounded-full hover:bg-red-700 transition duration-300">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-12">
                <a href="/marketplace"
                    class="text-lg font-semibold text-red-600 hover:text-red-700 underline transition duration-300">
                    Lihat Semua Produk di Marketplace →
                </a>
            </div>

        </div>

    </section>


    {{-- BAGIAN 3: LOGO PARTNER/MITRA --}}
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 text-center mb-12 leading-tight">
                Didukung oleh <span class="text-red-600">Mitra Bisnis Terpercaya</span>
            </h2>

            {{-- Grid Logo Partner --}}
            <div
                class="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-6 xl:grid-cols-7 gap-4 justify-items-center items-center">

                <img src="{{ asset('assets/img/partners/1.png') }}" alt="Logo Partner 1"
                    class="h-20 md:h-24 w-auto object-contain hover:grayscale-0 transition duration-300 transform hover:scale-105">

                <img src="{{ asset('assets/img/partners/3.png') }}" alt="Logo Partner 3"
                    class="h-20 md:h-24 w-auto object-contain hover:grayscale-0 transition duration-300 transform hover:scale-105">

                <img src="{{ asset('assets/img/partners/4.png') }}" alt="Logo Partner 4"
                    class="h-20 md:h-24 w-auto object-contain hover:grayscale-0 transition duration-300 transform hover:scale-105">

                <img src="{{ asset('assets/img/partners/5.png') }}" alt="Logo Partner 5"
                    class="h-20 md:h-24 w-auto object-contain hover:grayscale-0 transition duration-300 transform hover:scale-105">

                <img src="{{ asset('assets/img/partners/6.png') }}" alt="Logo Partner 6"
                    class="h-20 md:h-24 w-auto object-contain hover:grayscale-0 transition duration-300 transform hover:scale-105">

                <img src="{{ asset('assets/img/partners/7.png') }}" alt="Logo Partner 7"
                    class="h-20 md:h-24 w-auto object-contain hover:grayscale-0 transition duration-300 transform hover:scale-105">

                <img src="{{ asset('assets/img/partners/8.png') }}" alt="Logo Partner 8"
                    class="h-20 md:h-24 w-auto object-contain hover:grayscale-0 transition duration-300 transform hover:scale-105">

                <img src="{{ asset('assets/img/partners/9.png') }}" alt="Logo Partner 9"
                    class="h-20 md:h-24 w-auto object-contain hover:grayscale-0 transition duration-300 transform hover:scale-105">

                <img src="{{ asset('assets/img/partners/10.png') }}" alt="Logo Partner 10"
                    class="h-20 md:h-24 w-auto object-contain hover:grayscale-0 transition duration-300 transform hover:scale-105">

                <img src="{{ asset('assets/img/partners/11.png') }}" alt="Logo Partner 11"
                    class="h-20 md:h-24 w-auto object-contain hover:grayscale-0 transition duration-300 transform hover:scale-105">

            </div>
            <p class="text-center text-gray-500 text-base mt-8">
                Kami bangga bekerja sama dengan berbagai organisasi untuk memberdayakan UMKM di seluruh Indonesia.
            </p>
        </div>
    </section>

@endsection
