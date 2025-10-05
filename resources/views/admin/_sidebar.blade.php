<nav class="space-y-2">
    <p class="text-xs font-bold uppercase text-gray-500 mb-4">Panel Admin</p>

    {{-- KELOMPOK: DASHBOARD & OPERASIONAL --}}

    {{-- Link Dashboard Utama (Icon: Chart Bar) --}}
    <a href="{{ route('admin.dashboard') }}"
        class="flex items-center p-3 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors duration-200 @if (request()->routeIs('admin.dashboard')) bg-red-100 text-red-600 font-bold @endif">
        {{-- Ikon: Grafik Batang (Indikator Dashboard/Data) --}}
        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
        </svg>
        Dashboard Utama
    </a>

    {{-- Link Semua Pesanan (Icon: Receipt) --}}
    <a href="{{ route('admin.orders.index') }}"
        class="flex items-center p-3 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors duration-200 @if (request()->routeIs('admin.orders.*')) bg-red-100 text-red-600 font-bold @endif">
        {{-- Ikon: Resi/Daftar Pesanan --}}
        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M10 16h.01">
            </path>
        </svg>
        Semua Pesanan
    </a>

    <hr class="my-3 border-gray-200">

    <p class="text-xs font-bold uppercase text-gray-500 mb-4 mt-6">Manajemen Mitra & Akun</p>

    {{-- KELOMPOK UTAMA: MANAJEMEN MITRA UMKM (Icon: Storefront) --}}
    <div x-data="{ umkmOpen: {{ request()->routeIs('admin.umkms.*') ? 'true' : 'false' }} }">
        <button @click="umkmOpen = !umkmOpen"
            class="flex items-center justify-between w-full p-3 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors duration-200 
            @if (request()->routeIs('admin.umkms.*')) bg-red-100 text-red-600 font-bold @endif">
            <span class="flex items-center">
                {{-- Ikon: Toko/Storefront --}}
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                Manajemen UMKM
            </span>
            <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-90': umkmOpen }" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>

        <div x-show="umkmOpen" class="space-y-1 ml-4 border-l pl-3 py-1">

            {{-- Submenu 1: Daftar Mitra (INDEX) --}}
            <a href="{{ route('admin.umkms.index') }}"
                class="block p-2 rounded-lg text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 @if (request()->routeIs('admin.umkms.index')) bg-red-100 text-red-600 font-semibold @endif">
                Daftar Mitra
            </a>

            {{-- Submenu 2: Tambah Baru (CREATE) --}}
            <a href="{{ route('admin.umkms.create') }}"
                class="block p-2 rounded-lg text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 @if (request()->routeIs('admin.umkms.create')) bg-red-100 text-red-600 font-semibold @endif">
                Tambah UMKM Baru
            </a>

        </div>
    </div>

    <hr class="my-3 border-gray-200">

    <p class="text-xs font-bold uppercase text-gray-500 mb-4 mt-6">Manajemen Konten</p>

    {{-- Link Manajemen Produk (Icon: Price Tag) --}}
    <a href="{{ route('admin.products.index') }}"
        class="flex items-center p-3 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors duration-200 @if (request()->routeIs('admin.products.*')) bg-red-100 text-red-600 font-bold @endif">
        {{-- Ikon: Label Harga (Produk) --}}
        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M7 7h.01M16 17H5a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2z" />
        </svg>
        Manajemen Produk
    </a>

    {{-- Link BARU: Manajemen Carousel (Icon: Pictures/Slideshow) --}}
    <a href="{{ route('admin.carousels.index') }}"
        class="flex items-center p-3 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors duration-200 @if (request()->routeIs('admin.carousels.*')) bg-red-100 text-red-600 font-bold @endif">
        {{-- Ikon: Carousel/Gambar --}}
        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 16l.17-.17c1.33-1.33 3.33-1.33 4.66 0l1.33 1.33c1.33 1.33 3.33 1.33 4.66 0L19 16M4 20h16M15 9h.01M2 6a2 2 0 012-2h16a2 2 0 012 2v12a2 2 0 01-2 2H4a2 2 0 01-2-2V6z">
            </path>
        </svg>
        Manajemen Carousel
    </a>

    <hr class="my-3 border-gray-200">

    <p class="text-xs font-bold uppercase text-gray-500 mb-4 mt-6">Manajemen Akun</p>

    {{-- Link Manajemen User (Icon: Users) --}}
    <a href="{{ route('admin.users.index') }}"
        class="flex items-center p-3 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors duration-200 @if (request()->routeIs('admin.users.*')) bg-red-100 text-red-600 font-bold @endif">
        {{-- Ikon: Grup Pengguna --}}
        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20v-2a3 3 0 00-5.356-1.857M9 20v-4a6 6 0 0112 0v4M6.354 15c-1.229 0-2.43 0.231-3.6 0.648.711 1.05 1.554 1.865 2.501 2.528A4.9 4.9 0 0016 16.5c0-.98-.298-1.92-1.002-2.735zM9 10a2 2 0 11-4 0 2 2 0 014 0zm0 0l.01.01">
            </path>
        </svg>
        Semua Pengguna
    </a>

</nav>
