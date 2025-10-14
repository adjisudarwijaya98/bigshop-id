<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - Bigshop UMKM</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}"></script>
</head>

<body class="bg-gray-50">

    {{-- 1. HEADER (Posisi Fixed di Atas, z-40) --}}
    {{-- Pastikan file _header_dashboard menggunakan kelas 'fixed top-0 left-0 w-full z-40' --}}
    @include('layouts._header_dashboard')

    {{-- 2. Sidebar (Posisi Fixed, dimulai 4rem / top-16 dari atas, z-30) --}}
    {{-- Menggunakan kode sidebar yang diperbaiki (w-64, fixed top-16) --}}
    <aside class="w-64 bg-white shadow-xl border-r fixed top-16 left-0 h-[calc(100vh-4rem)] z-30 overflow-y-auto">
        @include('umkm._sidebar')
    </aside>

    {{-- 3. Konten Utama (Main) --}}
    {{-- Berikan padding kiri (pl-64) untuk mengimbangi lebar sidebar (w-64) --}}
    {{-- Berikan padding atas (pt-8) atau margin atas yang sesuai. Di sini kita menggunakan pt-8 sebagai bagian dari p-8 --}}
    <main class="flex-1 pl-64 pt-20 p-8 min-h-screen">
        {{-- pt-20 ditambahkan agar konten tidak tertutup oleh header (h-16) dan memiliki spasi di bawah header --}}

        <div class="max-w-full mx-auto">
            @yield('content')
        </div>
    </main>

</body>

</html>
