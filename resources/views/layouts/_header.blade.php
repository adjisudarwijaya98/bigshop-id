<header class="bg-white shadow-md sticky top-0 z-50" x-data="{ isMobileMenuOpen: false }">
    <div class="container mx-auto px-6 py-4 flex items-center justify-between">
        {{-- LOGO (Kiri) --}}
        <a href="/" class="flex items-center space-x-2">
            <span class="text-2xl md:text-3xl font-extrabold text-red-600">Baru.Id</span>
        </a>

        {{-- NAVIGASI UTAMA (Hanya Desktop) --}}
        <nav class="hidden md:flex items-center space-x-6">
            <a href="/"
                class="text-gray-600 hover:text-red-600 font-semibold transition-colors duration-300">Home</a>
            <a href="/marketplace"
                class="text-gray-600 hover:text-red-600 font-semibold transition-colors duration-300">Marketplace</a>
            <a href="{{ route('e_learning.categories.index') }}"
                class="text-gray-600 hover:text-red-600 font-semibold transition-colors duration-300">E-learning</a>
        </nav>

        {{-- KONTROL KANAN (Search, Cart, Auth/Guest, Hamburger) --}}
        <div class="flex items-center space-x-4">

            {{-- Search Bar (Hanya Desktop) --}}
            <div class="relative hidden lg:block">
                <input type="text" placeholder="Cari produk UMKM..."
                    class="w-72 pl-10 pr-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-600">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400">
                    <path fill-rule="evenodd"
                        d="M10.5 3.75a6.75 6.75 0 100 13.5 6.75 6.75 0 000-13.5zM2.25 10.5a8.25 8.25 0 1114.59 5.28l4.69 4.69a.75.75 0 11-1.06 1.06l-4.69-4.69A8.25 8.25 0 012.25 10.5z"
                        clip-rule="evenodd" />
                </svg>
            </div>

            {{-- Keranjang Belanja (Selalu Terlihat) --}}
            <a href="{{ route('cart.index') }}"
                class="text-gray-600 hover:text-red-600 font-semibold transition-colors duration-300 relative">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                    </path>
                </svg>
                @php $cartCount = count(session('cart', [])); @endphp
                @if ($cartCount > 0)
                    <span
                        class="absolute -top-2 -right-2 bg-red-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">{{ $cartCount }}</span>
                @endif
            </a>

            {{-- Auth/Guest Links (Hanya Desktop) --}}
            <div class="hidden md:flex items-center space-x-4">
                @auth
                    {{-- Dropdown Container --}}
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" type="button"
                            class="flex items-center text-sm font-semibold rounded-full focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-300"
                            aria-expanded="false" aria-haspopup="true">
                            <span class="text-gray-700 hover:text-red-600">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 ml-1 transition-transform" :class="{ 'rotate-180': open }" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>

                        {{-- Konten Dropdown Menu --}}
                        <div x-show="open" @click.outside="open = false"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute right-0 z-20 mt-3 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">

                            <div class="px-4 py-2 text-sm text-gray-600 border-b">
                                Masuk sebagai:<br><span class="font-bold">{{ Auth::user()->name }}</span>
                            </div>

                            @if (Auth::user()->is_admin)
                                <a href="{{ route('admin.dashboard') }}"
                                    class="block px-4 py-2 text-sm text-red-700 font-semibold hover:bg-red-50"
                                    role="menuitem">
                                    Dashboard ADMINISTRATOR
                                </a>
                                <div class="border-t my-1"></div>
                            @endif

                            @if (Auth::user()->umkmProfile)
                                <a href="{{ route('umkm.dashboard') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50" role="menuitem">
                                    Dashboard UMKM
                                </a>
                            @endif

                            <a href="{{ route('user.orders.history') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50" role="menuitem">
                                Riwayat Pesanan
                            </a>

                            <div class="border-t my-1"></div>

                            {{-- Logout --}}
                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <button type="submit"
                                    class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50"
                                    role="menuitem">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth

                @guest
                    <a href="{{ route('login') }}"
                        class="text-gray-600 hover:text-red-600 font-semibold transition-colors duration-300">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                        class="text-white bg-red-600 font-semibold py-2 px-4 rounded-full shadow-md hover:bg-red-700 transition duration-300">
                        Register
                    </a>
                @endguest
            </div>

            {{-- Tombol Hamburger (Hanya Mobile) --}}
            <button @click="isMobileMenuOpen = !isMobileMenuOpen"
                class="md:hidden text-gray-600 hover:text-red-600 focus:outline-none">
                <svg x-show="!isMobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7">
                    </path>
                </svg>
                <svg x-show="isMobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>
    </div>

    {{-- MOBILE MENU (Collapsible) --}}
    <div x-show="isMobileMenuOpen" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4"
        class="md:hidden bg-white shadow-lg border-t border-gray-100 py-4 px-6 absolute w-full z-40">

        {{-- Search Bar Mobile --}}
        <div class="relative mb-4">
            <input type="text" placeholder="Cari produk UMKM..."
                class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-600">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400">
                <path fill-rule="evenodd"
                    d="M10.5 3.75a6.75 6.75 0 100 13.5 6.75 6.75 0 000-13.5zM2.25 10.5a8.25 8.25 0 1114.59 5.28l4.69 4.69a.75.75 0 11-1.06 1.06l-4.69-4.69A8.25 8.25 0 012.25 10.5z"
                    clip-rule="evenodd" />
            </svg>
        </div>

        {{-- Navigasi Mobile --}}
        <nav class="flex flex-col space-y-3 pb-4 border-b border-gray-100">
            <a href="/"
                class="text-gray-700 hover:text-red-600 font-medium transition-colors duration-300 py-1">Home</a>
            <a href="/marketplace"
                class="text-gray-700 hover:text-red-600 font-medium transition-colors duration-300 py-1">Marketplace</a>
            <a href="{{ route('e_learning.categories.index') }}"
                class="text-gray-700 hover:text-red-600 font-medium transition-colors duration-300 py-1">E-learning</a>
        </nav>

        {{-- Auth/Guest Mobile --}}
        <div class="pt-4 flex flex-col space-y-3">
            @auth
                {{-- Dropdown Menu (Diperluas di Mobile) --}}
                <div class="text-sm font-semibold text-gray-800 border-b pb-2 mb-2">
                    Akun: {{ Auth::user()->name }}
                </div>

                @if (Auth::user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}"
                        class="text-red-700 font-semibold hover:text-red-800 transition">
                        Dashboard ADMINISTRATOR
                    </a>
                @endif

                @if (Auth::user()->umkmProfile)
                    <a href="{{ route('umkm.dashboard') }}" class="text-gray-700 hover:text-red-600 transition">
                        Dashboard UMKM
                    </a>
                @endif

                <a href="{{ route('user.orders.history') }}" class="text-gray-700 hover:text-red-600 transition">
                    Riwayat Pesanan
                </a>

                {{-- Logout --}}
                <form method="POST" action="{{ route('logout') }}" class="w-full pt-2 border-t mt-2">
                    @csrf
                    <button type="submit"
                        class="w-full text-left text-red-600 font-semibold hover:text-red-700 transition">
                        Logout
                    </button>
                </form>
            @endauth

            @guest
                <a href="{{ route('login') }}"
                    class="text-gray-600 hover:text-red-600 font-semibold transition-colors duration-300">
                    Login
                </a>
                <a href="{{ route('register') }}"
                    class="text-white bg-red-600 font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-red-700 transition duration-300 text-center">
                    Register
                </a>
            @endguest
        </div>
    </div>
</header>
