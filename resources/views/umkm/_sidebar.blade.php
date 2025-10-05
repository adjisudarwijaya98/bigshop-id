<nav class="p-4 pt-8">
    <p class="uppercase text-xs text-gray-400 mb-4 font-semibold tracking-wider">Navigasi Utama</p>
    <ul class="space-y-2">
        <li>
            {{-- Link Dashboard (Icon: Chart Bar) --}}
            <a href="{{ route('umkm.dashboard') }}"
                class="flex items-center p-3 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors duration-200 @if (request()->routeIs('umkm.dashboard')) bg-red-100 text-red-600 font-bold @endif">
                {{-- Ikon: Grafik/Data Metrik --}}
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                </svg>
                Dashboard
            </a>
        </li>
        <li>
            {{-- Link Manajemen Produk (Icon: Box/Package) --}}
            <a href="{{ route('umkm.products.index') }}"
                class="flex items-center p-3 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors duration-200 @if (request()->routeIs('umkm.products.*')) bg-red-100 text-red-600 font-bold @endif">
                {{-- Ikon: Box/Paket (Stok/Inventaris) --}}
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10m0-10l8 4m-8 4l-8 4">
                    </path>
                </svg>
                Manajemen Produk
            </a>
        </li>
        <li>
            {{-- Link Manajemen Pesanan (Icon: Shopping Cart/Receipt) --}}
            <a href="{{ route('umkm.orders.index') }}"
                class="flex items-center p-3 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors duration-200 @if (request()->routeIs('umkm.orders.*')) bg-red-100 text-red-600 font-bold @endif">
                {{-- Ikon: Keranjang Belanja --}}
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.767.707 1.767H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                    </path>
                </svg>
                Manajemen Pesanan
            </a>
        </li>

    </ul>
</nav>
