@extends('layouts.dashboard_layout')

@section('title', 'Tambah Produk Baru - Bigshop.Id')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Tambah Produk Baru</h1>
        <p class="text-gray-600">Isi detail produk yang akan dijual di marketplace.</p>
    </div>

    <form action="{{ route('umkm.products.store') }}" method="POST" enctype="multipart/form-data"
        class="bg-white p-8 rounded-lg shadow-xl">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Produk</label>
                <input type="text" name="name" id="name" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-red-500 focus:border-red-500">
            </div>

            <div>
                <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">Slug (URL Unik)</label>
                <input type="text" name="slug" id="slug" placeholder="otomatis-dibuat-dari-nama"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-3 bg-gray-50 cursor-not-allowed"
                    readonly>
            </div>

            <div>
                <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Harga (Rp)</label>
                <input type="number" name="price" id="price" required min="1000"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-red-500 focus:border-red-500">
            </div>

            <div>
                <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">Stok</label>
                <input type="number" name="stock" id="stock" required min="0"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-red-500 focus:border-red-500">
            </div>

            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                <select name="category_id" id="category_id" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-red-500 focus:border-red-500">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Gambar Produk</label>
                <input type="file" name="image" id="image" required
                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
            </div>

        </div>

        <div class="mt-6">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Produk</label>
            <textarea name="description" id="description" rows="5" required
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-red-500 focus:border-red-500"></textarea>
        </div>

        <div class="mt-8">
            <button type="submit"
                class="w-full bg-red-600 text-white font-bold py-3 px-4 rounded-lg shadow-md hover:bg-red-700 transition duration-300">
                Simpan Produk
            </button>
        </div>
    </form>
@endsection
