@extends('layouts.dashboard_layout')

@section('title', 'Edit Pofile UMKM - Bigshop.Id')

@section('content')

    <body class="p-4 sm:p-8 bg-gray-50">
        <div class="max-w-5xl mx-auto bg-white p-6 sm:p-10 rounded-2xl shadow-3xl border border-gray-100/50">
            <h1 class="text-3xl font-extrabold text-gray-900 mb-8 border-b-2 border-indigo-500/20 pb-4">
                <svg class="inline-block w-8 h-8 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                    </path>
                </svg>
                Kelola Profil Toko Anda
            </h1>

            <!-- Notifikasi (Lebih Profesional) -->
            @if (session('success'))
                <div class="p-4 mb-6 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                    role="alert">
                    <span class="font-bold">Berhasil!</span> {{ session('success') }}
                </div>
            @endif
            @if (session('info'))
                <div class="p-4 mb-6 text-sm text-blue-700 bg-blue-100 rounded-lg dark:bg-blue-200 dark:text-blue-800"
                    role="alert">
                    <span class="font-bold">Informasi:</span> {{ session('info') }}
                </div>
            @endif
            @if (session('error'))
                <div class="p-4 mb-6 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
                    role="alert">
                    <span class="font-bold">Error!</span> {{ session('error') }}
                </div>
            @endif

            <!-- Form Edit Profil -->
            <form action="{{ route('umkm.profile.update') }}" method="POST" class="space-y-8">
                @csrf
                @method('PUT')

                <!-- Store Name and Telepon (Grid Layout) -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="store_name" class="block text-sm font-semibold text-gray-800 mb-2">Nama Toko <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="store_name" id="store_name"
                            value="{{ old('store_name', $umkm->store_name) }}" required
                            class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition duration-150 ease-in-out @error('store_name') border-red-500 @enderror">
                        @error('store_name')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Telepon -->
                    <div>
                        <label for="telepon" class="block text-sm font-semibold text-gray-800 mb-2">Nomor Telepon
                            Toko</label>
                        <input type="text" name="telepon" id="telepon" value="{{ old('telepon', $umkm->telepon) }}"
                            class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition duration-150 ease-in-out @error('telepon') border-red-500 @enderror"
                            placeholder="Cth: 08123456789">
                        @error('telepon')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Location -->
                <div>
                    <label for="location" class="block text-sm font-semibold text-gray-800 mb-2">Lokasi (Alamat Lengkap atau
                        Link Maps)</label>
                    <textarea name="location" id="location" rows="3"
                        class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition duration-150 ease-in-out @error('location') border-red-500 @enderror"
                        placeholder="Masukkan alamat lengkap atau link lokasi toko Anda.">{{ old('location', $umkm->location) }}</textarea>
                    @error('location')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-800 mb-2">Deskripsi Toko</label>
                    <textarea name="description" id="description" rows="5"
                        class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition duration-150 ease-in-out @error('description') border-red-500 @enderror"
                        placeholder="Jelaskan secara singkat jenis produk, sejarah singkat, atau keunggulan toko Anda.">{{ old('description', $umkm->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Is Active Checkbox -->
                <div class="relative flex items-start p-4 bg-indigo-50/50 border border-indigo-100 rounded-xl">
                    <div class="flex items-center h-5">
                        <input id="is_active" name="is_active" type="checkbox"
                            class="focus:ring-indigo-500 h-5 w-5 text-indigo-600 border-gray-300 rounded"
                            @if (old('is_active', $umkm->is_active)) checked @endif>
                    </div>
                    <div class="ml-4 text-sm">
                        <label for="is_active" class="font-bold text-gray-800">Toko Aktif</label>
                        <p class="text-gray-500 text-xs">Centang opsi ini jika Anda ingin toko Anda **dapat menerima
                            pesanan** dan **dilihat oleh publik**.</p>
                    </div>
                </div>

                <!-- Submit Button & Cancel Button (Enhanced Action Block - Lebih Rapi) -->
                <div class="pt-6 flex flex-col-reverse sm:flex-row justify-end gap-4">

                    <!-- Tombol Batal/Kembali (Aksi Sekunder) -->
                    <!-- PERHATIAN: Ganti 'umkm.dashboard' dengan nama route dashboard Anda yang sebenarnya! -->
                    <a href="{{ route('umkm.dashboard') }}"
                        class="w-full sm:w-auto px-6 py-3 flex justify-center border border-gray-300 rounded-xl shadow-md text-base font-bold text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                        Batal / Kembali
                    </a>

                    <!-- Tombol Simpan (Aksi Utama) -->
                    <button type="submit"
                        class="w-full sm:w-auto px-6 py-3 flex justify-center border border-transparent rounded-xl shadow-lg text-base font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-offset-2 focus:ring-indigo-500/50 transition duration-300 ease-in-out transform hover:scale-[1.01]">
                        <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Simpan Perubahan Profil
                    </button>
                </div>
            </form>
        </div>
    </body>

@endsection
