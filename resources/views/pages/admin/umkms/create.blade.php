@extends('layouts.admin_dashboard_layout')

@section('title', 'Tambah Mitra UMKM Baru')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Tambah Mitra UMKM Baru</h1>

    <div class="bg-white p-6 rounded-lg shadow-md border">

        <form action="{{ route('admin.umkms.store') }}" method="POST">
            @csrf

            <h2 class="text-xl font-semibold text-red-600 mb-4 border-b pb-2">Detail Akun Pemilik</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                {{-- Nama User --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap Pemilik</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-red-500 focus:ring-red-500 @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email User --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Pemilik (Login)</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-red-500 focus:ring-red-500 @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                {{-- Password --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-red-500 focus:ring-red-500 @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Konfirmasi Password --}}
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi
                        Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-red-500 focus:ring-red-500">
                </div>
            </div>

            <h2 class="text-xl font-semibold text-red-600 mb-4 border-b pb-2">Detail Toko UMKM</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                {{-- Nama Toko --}}
                <div>
                    <label for="umkm_name" class="block text-sm font-medium text-gray-700">Nama Toko UMKM</label>
                    <input type="text" name="umkm_name" id="umkm_name" value="{{ old('umkm_name') }}" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-red-500 focus:ring-red-500 @error('umkm_name') border-red-500 @enderror">
                    @error('umkm_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Nomor Telepon --}}
                <div>
                    <label for="phone_number" class="block text-sm font-medium text-gray-700">Nomor Telepon Toko</label>
                    <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-red-500 focus:ring-red-500 @error('phone_number') border-red-500 @enderror">
                    @error('phone_number')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Alamat Toko --}}
            <div class="mb-6">
                <label for="address" class="block text-sm font-medium text-gray-700">Alamat Toko</label>
                <textarea name="address" id="address" rows="3" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-red-500 focus:ring-red-500 @error('address') border-red-500 @enderror">{{ old('address') }}</textarea>
                @error('address')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Deskripsi (Opsional) --}}
            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi Singkat
                    (Opsional)</label>
                <textarea name="description" id="description" rows="2"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-red-500 focus:ring-red-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>


            <div class="flex justify-end">
                <button type="submit"
                    class="px-4 py-2 bg-red-600 text-white font-semibold rounded-md shadow-md hover:bg-red-700 transition duration-150">
                    Buat Akun UMKM & Aktifkan
                </button>
            </div>
        </form>
    </div>

@endsection
