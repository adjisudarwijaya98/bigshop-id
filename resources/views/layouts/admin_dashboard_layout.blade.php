<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Dashboard - @yield('title', config('app.name', 'Laravel'))</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}"></script>
</head>

<body class="font-sans antialiased bg-gray-100">

    <div id="admin-layout" class="min-h-screen">

        {{-- 1. Navigasi Atas (Header Admin Sederhana) --}}
        <header class="bg-white shadow-md">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                <h1 class="text-xl font-bold text-gray-800">Administrator Panel</h1>

                {{-- Dropdown Akun Admin --}}
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open"
                        class="flex items-center space-x-2 text-sm font-medium text-gray-700 hover:text-red-600 focus:outline-none">
                        <span>{{ Auth::user()->name }} (Admin)</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>

                    <div x-show="open" @click.outside="open = false"
                        class="absolute right-0 z-10 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        {{-- 2. Konten Utama (Sidebar & Body) --}}
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row gap-6">

                {{-- Sidebar --}}
                <aside class="w-full md:w-64">
                    <div class="bg-white rounded-lg shadow p-4">
                        @include('admin._sidebar') {{-- Menggunakan sidebar yang sudah Anda buat --}}
                    </div>
                </aside>

                {{-- Main Content --}}
                <main class="flex-1">
                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4"
                            role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="bg-white rounded-lg shadow p-6">
                        @yield('content')
                    </div>
                </main>
            </div>
        </div>

    </div>
</body>

</html>
