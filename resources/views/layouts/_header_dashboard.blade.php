<header class="bg-white shadow-lg fixed top-0 w-full z-30">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <a href="{{ url('/') }}" class="text-2xl font-bold text-red-600">
                Bigshop.Id <span class="text-sm text-gray-500 font-normal">| UMKM Dashboard</span>
            </a>

            <div class="flex items-center space-x-4">
                {{-- Logika Auth tetap sama --}}
                @auth
                    <span class="text-gray-600 text-sm">Hai, {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit"
                            class="text-white bg-red-600 font-semibold py-1 px-4 rounded-full shadow-md hover:bg-red-700 transition duration-300">
                            Logout
                        </button>
                    </form>
                @endauth
            </div>

        </div>
    </div>
</header>
