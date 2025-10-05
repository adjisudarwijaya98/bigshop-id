@extends('layouts.dashboard_layout')

@section('title', 'Edit Produk: ' . $product->name . ' - Bigshop.Id')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Edit Produk</h1>
        <p class="text-gray-600">Perbarui detail produk {{ $product->name }}.</p>
    </div>

    <form action="{{ route('umkm.products.update', $product) }}" method="POST" enctype="multipart/form-data"
        class="bg-white p-8 rounded-lg shadow-xl">
        {{-- Gunakan method PUT untuk update --}}
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Produk</label>
                <input type="text" name="name" id="name" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-red-500 focus:border-red-500"
                    value="{{ old('name', $product->name) }}">
            </div>

            <div>
                <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">Slug (URL Unik)</label>
                <input type="text" id="slug" readonly
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-3 bg-gray-50 cursor-not-allowed"
                    value="{{ $product->slug }}">
            </div>

            <div>
                <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Harga (Rp)</label>
                <input type="number" name="price" id="price" required min="1000"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-red-500 focus:border-red-500"
                    value="{{ old('price', $product->price) }}">
            </div>

            <div>
                <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">Stok</label>
                <input type="number" name="stock" id="stock" required min="0"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-red-500 focus:border-red-500"
                    value="{{ old('stock', $product->stock) }}">
            </div>

            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                <select name="category_id" id="category_id" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-red-500 focus:border-red-500">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Gambar Produk (Opsional)</label>
                <input type="file" name="image" id="image"
                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
                <p class="text-xs text-gray-500 mt-2">Gambar saat ini: <a
                        href="{{ asset('storage/' . $product->image_url) }}" target="_blank"
                        class="text-red-500 underline">Lihat</a></p>
            </div>

        </div>

        <div class="mt-6">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Produk</label>
            <textarea name="description" id="description" rows="5" required
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-red-500 focus:border-red-500">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="mt-8 flex justify-between">
            <a href="{{ route('umkm.products.index') }}"
                class="bg-gray-400 text-white font-bold py-3 px-4 rounded-lg shadow-md hover:bg-gray-500 transition duration-300">
                Batal
            </a>
            <button type="submit"
                class="w-1/3 bg-red-600 text-white font-bold py-3 px-4 rounded-lg shadow-md hover:bg-red-700 transition duration-300">
                Simpan Perubahan
            </button>
        </div>
    </form>
@endsection
