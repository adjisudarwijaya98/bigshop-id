<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - Bigshop UMKM</title>

    <!-- MENGGANTI @vite dan mix() dengan CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        /* Menggunakan font default sistem atau Figtree jika dimuat */
        body {
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        }
    </style>


</head>

<body class="bg-gray-50">

    {{-- 1. HEADER (Posisi Fixed di Atas, z-40) --}}
    {{-- CATATAN PENTING: File layouts._header_dashboard juga harus diperiksa dan dibersihkan dari komponen Blade/Vite/Mix. --}}
    @include('layouts._header_dashboard')

    {{-- 2. Sidebar (Posisi Fixed, dimulai 4rem / top-16 dari atas, z-30) --}}
    {{-- CATATAN PENTING: File umkm._sidebar juga harus diperiksa dan dibersihkan dari komponen Blade/Vite/Mix. --}}
    <aside class="w-64 bg-white shadow-xl border-r fixed top-16 left-0 h-[calc(100vh-4rem)] z-30 overflow-y-auto">
        @include('umkm._sidebar')
    </aside>

    {{-- 3. Konten Utama (Main) --}}
    {{-- Berikan padding kiri (pl-64) untuk mengimbangi lebar sidebar (w-64) --}}
    <main class="flex-1 pl-64 pt-20 p-8 min-h-screen">
        {{-- pt-20 ditambahkan agar konten tidak tertutup oleh header (h-16) dan memiliki spasi di bawah header --}}

        <div class="max-w-full mx-auto">
            @yield('content')
        </div>
    </main>


</body>

</html>
