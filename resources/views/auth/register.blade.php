<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bigshop.Id') }} - Daftar</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,600,700,800&display=swap" rel="stylesheet" />

    <!-- MENGGUNAKAN TAILWIND CDN AGAR STYLING BERJALAN. BARIS @vite DAN mix() DIHAPUS. -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Memastikan font Inter yang dimuat digunakan oleh Tailwind */
        .font-sans {
            font-family: 'Inter', sans-serif;
        }
    </style>


</head>

<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen flex">

        <!-- Kolom Kiri: Gambar Promosi (Hanya tampil di layar besar) -->
        <div class="hidden lg:block w-1/2 bg-red-600 relative">

            <!-- Background Image Placeholder (Ganti dengan gambar Anda) -->
            <div class="absolute inset-0 bg-cover bg-center opacity-30"
                style="background-image: url('https://placehold.co/1200x800/22c55e/ffffff/webp?text=UMKM+Go+Digital');">
            </div>

            <!-- Konten Marketing -->
            <div class="relative z-10 p-16 flex flex-col justify-center h-full text-white">
                <h1 class="text-6xl font-extrabold leading-tight mb-4">
                    Bergabung dengan Bigshop.Id
                </h1>
                <p class="text-3xl font-light mb-8">
                    Daftarkan UMKM Anda sekarang dan raih potensi pasar yang lebih luas bersama kami.
                </p>
                <div class="text-xl font-medium">
                    <ul class="space-y-3">
                        <li class="flex items-center">
                            <svg class="w-6 h-6 mr-3 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944c2.57 0 4.96.93 6.818 2.54A11.955 11.955 0 0121.056 12c0 2.57-.93 4.96-2.54 6.818A11.955 11.955 0 0112 21.056c-2.57 0-4.96-.93-6.818-2.54A11.955 11.955 0 012.944 12c0-2.57.93-4.96 2.54-6.818A11.955 11.955 0 0112 2.944z">
                                </path>
                            </svg>
                            Pendaftaran Cepat dan Mudah
                        </li>
                        <li class="flex items-center">
                            <svg class="w-6 h-6 mr-3 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            Langsung Dapatkan Dashboard Admin
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Form Pendaftaran -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 lg:p-16">
            <div class="w-full max-w-md bg-white p-8 sm:p-10 rounded-xl shadow-2xl border border-gray-100">

                <!-- Logo Aplikasi -->
                <div class="flex flex-col items-center mb-8">
                    <a href="/">
                        <!-- Asumsi logo tersimpan di assets/img/logo.png -->
                        <img src="{{ asset('assets/img/partners/2.png') }}" alt="Logo Bigshop.Id"
                            class="h-14 w-auto mb-3">
                    </a>
                    <h2 class="text-3xl font-extrabold text-gray-900 text-center">
                        Daftar Akun Baru
                    </h2>
                    <p class="text-sm text-gray-500 mt-1">Isi data Anda untuk memulai.</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name (Diubah ke tag HTML standar) -->
                    <div class="mb-4">
                        <label for="name" class="block font-medium text-sm text-gray-700">Nama Lengkap</label>
                        <input id="name"
                            class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring focus:ring-red-500 focus:ring-opacity-50"
                            type="text" name="name" value="{{ old('name') }}" required autofocus
                            autocomplete="name" />
                        @error('name')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Address (Diubah ke tag HTML standar) -->
                    <div class="mb-4">
                        <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                        <input id="email"
                            class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring focus:ring-red-500 focus:ring-opacity-50"
                            type="email" name="email" value="{{ old('email') }}" required
                            autocomplete="username" />
                        @error('email')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password (Diubah ke tag HTML standar) -->
                    <div class="mb-4">
                        <label for="password" class="block font-medium text-sm text-gray-700">Password</label>
                        <input id="password"
                            class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring focus:ring-red-500 focus:ring-opacity-50"
                            type="password" name="password" required autocomplete="new-password" />
                        @error('password')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password (Diubah ke tag HTML standar) -->
                    <div class="mb-4">
                        <label for="password_confirmation" class="block font-medium text-sm text-gray-700">Konfirmasi
                            Password</label>
                        <input id="password_confirmation"
                            class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring focus:ring-red-500 focus:ring-opacity-50"
                            type="password" name="password_confirmation" required autocomplete="new-password" />
                        @error('password_confirmation')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tombol Register dan Batal (Diubah ke tag HTML standar) -->
                    <div class="flex flex-col items-center justify-center mt-8 space-y-3">
                        <button type="submit"
                            class="w-full justify-center bg-red-600 text-white hover:bg-red-700 transition duration-150 rounded-lg py-2 px-6 font-semibold shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                            {{ __('Daftar Sekarang') }}
                        </button>

                        <!-- Tombol Batal/Kembali ke Home -->
                        <a href="{{ url('/') }}"
                            class="w-full text-center py-2 px-6 text-sm font-semibold text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition duration-150 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">
                            Batal
                        </a>
                    </div>

                    <!-- Link Login -->
                    <div class="text-center mt-6 text-sm">
                        <a class="font-semibold text-red-600 hover:text-red-800 transition duration-150"
                            href="{{ route('login') }}">
                            {{ __('Sudah punya akun? Masuk') }}
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>


</body>

</html>
