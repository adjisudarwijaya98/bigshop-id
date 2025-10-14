{{-- Hapus 'container mx-auto max-w-7xl' dari div pembungkus utama Header --}}
<header class="bg-white fixed top-0 left-0 w-full z-40 border-b border-gray-100 shadow-sm">

    {{-- Container untuk isi header, tetap gunakan lebar penuh, tapi berikan padding horizontal --}}
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            {{-- Logo dan Subtitle Dashboard --}}
            {{-- Tambahkan 'w-64' atau sesuaikan agar logonya sejajar dengan lebar sidebar --}}
            <a href="{{ url('/') }}" class="flex items-baseline space-x-2 w-64">

                {{-- Logo Merah Gelap --}}
                <span class="text-xl md:text-2xl font-extrabold text-red-700 tracking-tight">
                    Bigshop.Id
                </span>

                {{-- Subtitle Dashboard --}}
                <span
                    class="hidden sm:inline text-sm text-gray-500 font-medium border-l border-gray-300 pl-3 leading-none whitespace-nowrap">
                    UMKM Dashboard
                </span>
            </a>

            {{-- Area Pengguna (User Info & Logout) --}}
            <div class="flex items-center space-x-3 sm:space-x-4">
                @auth
                    {{-- Nama Pengguna (Terletak di kanan) --}}
                    <span class="hidden sm:inline text-sm text-gray-600 font-medium">
                        Halo, <span class="font-semibold text-gray-800">{{ Auth::user()->name }}</span>
                    </span>

                    {{-- Tombol Logout --}}
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit"
                            class="flex items-center text-sm font-semibold py-2 px-4 rounded-lg 
                                   bg-red-600 text-white shadow-md transition duration-200 
                                   hover:bg-red-700 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Keluar
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </div>
</header>
