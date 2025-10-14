<nav
    class="w-64 flex flex-col h-full bg-white shadow-xl border-r border-gray-200 fixed top-16 left-0 z-30 overflow-y-auto">
    <div class="p-6">
        <h2 class="uppercase text-xs text-gray-500 mb-4 font-semibold tracking-widest">
            NAVIGASI UMKM
        </h2>
        <ul class="space-y-1">

            {{-- Link Dashboard (Icon: Pie Chart) --}}
            <li>
                <a href="{{ route('umkm.dashboard') }}"
                    class="flex items-center py-3 px-4 rounded-lg text-sm transition-all duration-200 
                          @if (request()->routeIs('umkm.dashboard')) {{-- Aktif: Merah Muda Lembut & Teks Merah Gelap --}}
                              bg-red-50 text-red-700 font-bold shadow-sm
                          @else 
                              {{-- Non-Aktif: Hover Merah & Abu-abu Biasa --}}
                              text-gray-600 hover:bg-gray-50 hover:text-red-600 font-medium @endif">
                    {{-- Ikon: Grafik/Data Metrik --}}
                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                    </svg>
                    Dashboard
                </a>
            </li>

            {{-- Link Manajemen Produk (Icon: Box/Package) --}}
            <li>
                <a href="{{ route('umkm.products.index') }}"
                    class="flex items-center py-3 px-4 rounded-lg text-sm transition-all duration-200
                          @if (request()->routeIs('umkm.products.*')) {{-- Aktif: Merah Muda Lembut & Teks Merah Gelap --}}
                              bg-red-50 text-red-700 font-bold shadow-sm
                          @else 
                              {{-- Non-Aktif: Hover Merah & Abu-abu Biasa --}}
                              text-gray-600 hover:bg-gray-50 hover:text-red-600 font-medium @endif">
                    {{-- Ikon: Box/Paket (Stok/Inventaris) --}}
                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10m0-10l8 4m-8 4l-8 4">
                        </path>
                    </svg>
                    Manajemen Produk
                </a>
            </li>

            {{-- Link Manajemen Pesanan (Icon: Shopping Cart/Receipt) --}}
            <li>
                <a href="{{ route('umkm.orders.index') }}"
                    class="flex items-center py-3 px-4 rounded-lg text-sm transition-all duration-200
                          @if (request()->routeIs('umkm.orders.*')) {{-- Aktif: Merah Muda Lembut & Teks Merah Gelap --}}
                              bg-red-50 text-red-700 font-bold shadow-sm
                          @else 
                              {{-- Non-Aktif: Hover Merah & Abu-abu Biasa --}}
                              text-gray-600 hover:bg-gray-50 hover:text-red-600 font-medium @endif">
                    {{-- Ikon: Keranjang Belanja --}}
                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.767.707 1.767H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                    Manajemen Pesanan
                </a>
            </li>
        </ul>
    </div>
</nav>
