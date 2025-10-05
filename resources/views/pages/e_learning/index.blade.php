@extends('layouts.main')

@section('title', 'Kategori Kursus Terbaik untuk UMKM')

@section('content')

    <style>
        /* CSS untuk elemen abstrak dan animasi hero */
        @keyframes pulse-slow {

            0%,
            100% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.05);
                opacity: 0.8;
            }

        }

        .animate-pulse-slow {
            animation: pulse-slow 4s infinite ease-in-out;
        }

        @keyframes float {
            0% {
                transform: translate(0, 0) rotate(0deg);
            }

            50% {
                transform: translate(0, -10px) rotate(2deg);
            }

            100% {
                transform: translate(0, 0) rotate(0deg);
            }

        }

        .animate-float {
            animation: float 6s infinite ease-in-out;
        }

        /* Kustomisasi font untuk judul hero /
                        .hero-title {
                        font-size: 4rem; / 64px, sesuai referensi */
        line-height: 1.1;
        }

        @media (max-width: 1024px) {
            .hero-title {
                font-size: 3rem;
                /* 48px untuk tablet /
                        }
                        }
                        @media (max-width: 768px) {
                        .hero-title {
                        font-size: 2.5rem; / 40px untuk mobile */
                line-height: 1.2;
            }
        }
    </style>

    {{-- Container Utama (pt-4 md:pt-8 untuk jarak dekat dari navbar) --}}

    <div class="container mx-auto px-4 pt-4 pb-16 md:pt-8 md:pb-24">

        {{-- 
    ====================================================
    HEADER HERO BARU (Minimalis, Profesional, dan Aset Lengkap)
    ====================================================
--}}
        {{-- Menghilangkan padding horizontal (px-0) agar elemen dekoratif bisa keluar dari batas container jika perlu --}}
        <div
            class="bg-white rounded-[32px] p-6 md:p-12 lg:p-20 mb-12 md:mb-20 overflow-hidden relative shadow-2xl shadow-gray-100/50">

            {{-- DEKORASI ABSTRACT (Sesuai Referensi image_bed986.png) --}}

            {{-- Ikon Bintang Merah Muda (Kanan Atas) --}}
            <div class="hidden md:block absolute top-1/4 right-5 p-2 rounded-full z-0 animate-pulse-slow">
                <svg class="w-8 h-8 text-red-300/80 transform rotate-45" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279L12 18.896l-7.416 3.917 1.48-8.279L.001 9.306l8.332-1.151L12 .587z" />
                </svg>
            </div>

            {{-- Ikon Kotak Biru (Kiri Tengah) --}}
            <div
                class="absolute top-1/2 left-0 lg:left-[50%] transform -translate-x-1/2 -translate-y-1/2 p-3 bg-blue-100/70 rounded-xl z-0 animate-float hidden lg:block">
                <svg class="w-6 h-6 text-blue-500" fill="currentColor" viewBox="0 0 24 24">
                    <rect width="24" height="24" rx="4" />
                </svg>
            </div>

            {{-- Ikon Teks Hijau (Kiri Bawah) --}}
            <div class="absolute bottom-10 left-10 p-3 rounded-xl z-0 hidden sm:block">
                <svg class="w-6 h-6 text-green-500" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M21 7.5l-2.25 2.25m0 0l-2.25-2.25m2.25 2.25v-2.25m0 0L17.25 15m0 0L15 17.25m2.25-2.25H9.75M3 18.75V5.25A2.25 2.25 0 015.25 3h13.5A2.25 2.25 0 0121 5.25v13.5A2.25 2.25 0 0118.75 21H5.25A2.25 2.25 0 013 18.75z" />
                </svg>
            </div>


            <div class="flex flex-col lg:flex-row items-center justify-between">

                {{-- KONTEN TEKS (Kiri) --}}
                <div class="lg:w-6/12 xl:w-5/12 text-center lg:text-left mb-10 lg:mb-0 z-10">

                    {{-- Judul Besar --}}
                    <h1 class="text-4xl md:text-5xl hero-title font-extrabold text-gray-900 mb-6">
                        Kuasai Ratusan Skill, Bangun Portfolio & Bersertifikat.
                    </h1>

                    {{-- Deskripsi --}}
                    <p class="text-lg text-gray-700 max-w-xl mx-auto lg:mx-0 mb-8 font-light">
                        Akses semua materi sekali bayar. Lebih dari sekadar nonton rekaman. Belajar fleksibel via: **Video
                        Materi • Case Study & Praktik • Bahan Bacaan • Komunitas.**
                    </p>

                    {{-- Tombol Aksi (Tiga Tombol - Mengembalikan 'Dapatkan Promo') --}}
                    <div class="flex flex-col sm:flex-row flex-wrap gap-4 justify-center lg:justify-start">
                        <button
                            class="py-3 px-6 bg-yellow-500 text-gray-900 font-bold rounded-xl hover:bg-yellow-600 transition duration-300 shadow-lg transform hover:scale-[1.02] w-full sm:w-auto">
                            Mulai Berlangganan
                        </button>
                        <button
                            class="py-3 px-6 bg-teal-600 text-white font-bold rounded-xl hover:bg-teal-700 transition duration-300 shadow-lg transform hover:scale-[1.02] w-full sm:w-auto">
                            Lihat 1400+ Materi
                        </button>
                        <button
                            class="py-3 px-6 bg-green-600 text-white font-bold rounded-xl hover:bg-green-700 transition duration-300 shadow-lg transform hover:scale-[1.02] w-full sm:w-auto">
                            Dapatkan Promo
                        </button>
                    </div>

                    <p class="text-sm font-bold text-orange-600 mt-4 tracking-wide">
                        2.000+ Orang Berlangganan Setiap Minggu
                    </p>
                </div>

                {{-- AREA VISUAL (Kanan - Lingkaran Dashed) --}}
                <div class="lg:w-6/12 xl:w-7/12 relative flex justify-center items-center h-80 md:h-96 z-0">

                    {{-- Lingkaran Dashed Border --}}
                    <div
                        class="w-[300px] h-[300px] md:w-[450px] md:h-[450px] rounded-full absolute border-4 border-dashed border-blue-200/50 animate-pulse-slow">
                    </div>

                    {{-- Image Container (Dikelilingi lingkaran solid dan shadow) --}}
                    <div
                        class="w-[280px] h-[280px] md:w-[430px] md:h-[430px] bg-gray-100 rounded-full overflow-hidden shadow-2xl relative z-10 flex items-center justify-center border-8 border-white">
                        <img src="{{ asset('assets/img/partners/hero.png') }}" alt="Pengusaha Sukses E-Learning"
                            onerror="this.onerror=null;this.src='{{ asset('assets/img/partners/hero.png') }}';"
                            class="w-full h-full object-cover transition-opacity duration-500">
                    </div>
                </div>

            </div>
        </div>


        {{-- 
    ====================================================
    Kategori Grid (Sudah Diperbaiki Gambar Tidak Gepeng)
    ====================================================
--}}
        <div class="text-center mb-12 md:mb-16">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 leading-tight">
                Pilih Kategori Kursus Pilihan Anda
            </h2>
            <p class="text-lg text-gray-600 max-w-4xl mx-auto mt-2">
                Jelajahi berbagai bidang yang esensial untuk memajukan UMKM Anda.
            </p>
        </div>

        @if ($categories->isEmpty())
            <div class="text-center py-20 bg-gray-50 rounded-xl border border-dashed">
                <h3 class="text-2xl text-gray-500">Belum ada kategori kursus yang tersedia.</h3>
                <p class="text-gray-400 mt-2">Silakan tambahkan kategori melalui halaman Admin.</p>
            </div>
        @else
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">

                @foreach ($categories as $category)
                    <a href="#"
                        class="block bg-white rounded-2xl shadow-none hover:shadow-lg transition duration-300 transform hover:-translate-y-0.5 border border-gray-200 group overflow-hidden">

                        {{-- 1. BAGIAN GAMBAR/IKON (Menggunakan object-contain) --}}
                        <div
                            class="w-full h-40 md:h-52 bg-gray-50 overflow-hidden relative p-4 flex items-center justify-center rounded-t-2xl">
                            @if ($category->image_url)
                                <img src="{{ Storage::url($category->image_url) }}" alt="Gambar {{ $category->name }}"
                                    {{-- KEY FIX: Menggunakan object-contain agar gambar tidak gepeng dan tidak terpotong --}}
                                    class="w-full h-full object-contain transition duration-500 group-hover:scale-[1.05]">
                            @else
                                {{-- Placeholder yang lebih profesional --}}
                                <div
                                    class="w-full h-full flex items-center justify-center text-center text-red-500 bg-red-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.247m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.247" />
                                    </svg>
                                </div>
                            @endif
                        </div>

                        {{-- 2. BAGIAN TEKS dan DESKRIPSI --}}
                        <div class="p-5 text-center">
                            <h2
                                class="text-xl font-extrabold text-gray-900 leading-snug group-hover:text-teal-600 transition mb-2">
                                {{ $category->name }}
                            </h2>

                            <p class="text-sm font-semibold text-teal-600 mt-2 hover:text-red-500 transition">
                                {{ $category->courses_count ?? 0 }} Kursus Tersedia &rarr;
                            </p>
                        </div>
                    </a>
                @endforeach

            </div>
        @endif

        {{-- - SECTION PAKET E-LEARNING - --}}
        <div class="mt-20 pt-16 border-t border-gray-200">
            <h2 class="text-4xl font-extrabold text-center text-gray-900 mb-12">
                Pilih Paket E-Learning Terbaik Anda
            </h2>

            <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                {{-- Paket 1: Dasar --}}
                <div
                    class="bg-white p-8 rounded-2xl shadow-xl border-4 border-gray-100 transform hover:scale-[1.02] transition duration-300">
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Paket Dasar</h3>
                    <p class="text-gray-500 mb-6">Mulai perjalanan bisnis Anda dengan fondasi yang kuat.</p>
                    <div class="text-4xl font-extrabold text-gray-900 mb-8">
                        Rp 99.000 <span class="text-lg font-normal text-gray-500">/ bulan</span>
                    </div>

                    <ul class="space-y-3 text-gray-700 mb-8">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 14.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Akses 5 Kategori Kursus Dasar
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 14.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Materi Bisnis dan Pemasaran
                        </li>
                        <li class="flex items-center text-gray-400">
                            <svg class="w-5 h-5 text-red-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Tidak Termasuk Mentoring Khusus
                        </li>
                    </ul>

                    <button
                        class="w-full py-3 bg-gray-200 text-gray-600 font-bold rounded-full hover:bg-gray-300 transition duration-300">
                        Pilih Paket Dasar
                    </button>
                </div>

                {{-- Paket 2: Premium (Rekomendasi) --}}
                <div
                    class="bg-white p-8 rounded-2xl shadow-2xl border-4 border-teal-600 transform scale-[1.05] shadow-teal-200/50">
                    <div class="text-center mb-4">
                        <span
                            class="inline-block bg-teal-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">Paling
                            Populer</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Paket Premium</h3>
                    <p class="text-gray-500 mb-6">Akses penuh ke semua materi dan bimbingan ahli.</p>
                    <div class="text-4xl font-extrabold text-teal-600 mb-8">
                        Rp 199.000 <span class="text-lg font-normal text-gray-500">/ bulan</span>
                    </div>

                    <ul class="space-y-3 text-gray-700 mb-8">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 14.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Akses **Semua** Kategori Kursus
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 14.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            **Webinar Eksklusif** Bulanan
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 14.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Sertifikat Penyelesaian Modul
                        </li>
                    </ul>

                    <button
                        class="w-full py-3 bg-teal-600 text-white font-bold rounded-full hover:bg-teal-700 transition duration-300 shadow-lg transform hover:shadow-xl">
                        Pilih Paket Premium
                    </button>
                </div>

                {{-- Paket 3: Enterprise --}}
                <div
                    class="bg-white p-8 rounded-2xl shadow-xl border-4 border-gray-100 transform hover:scale-[1.02] transition duration-300">
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Paket Enterprise</h3>
                    <p class="text-gray-500 mb-6">Solusi lengkap untuk tim besar dan kebutuhan spesifik.</p>
                    <div class="text-4xl font-extrabold text-gray-900 mb-8">
                        Rp 499.000 <span class="text-lg font-normal text-gray-500">/ bulan</span>
                    </div>

                    <ul class="space-y-3 text-gray-700 mb-8">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 14.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Semua Fitur Paket Premium
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 14.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            **Mentoring 1-on-1** dengan Ahli
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 14.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Akses ke Data Analisis Kinerja
                        </li>
                    </ul>

                    <button
                        class="w-full py-3 bg-teal-100 text-teal-600 font-bold rounded-full hover:bg-teal-200 transition duration-300">
                        Hubungi Tim Penjualan
                    </button>
                </div>
            </div>
        </div>

    </div>

@endsection
