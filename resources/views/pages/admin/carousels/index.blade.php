@extends('layouts.admin_dashboard_layout')

@section('title', 'Manajemen Carousel & Banner')

@section('content')
    <div class="flex justify-between items-center mb-6 border-b pb-2">
        <h1 class="text-3xl font-extrabold text-gray-800">Manajemen Carousel</h1>
        <a href="{{ route('admin.carousels.create') }}"
            class="px-4 py-2 bg-red-600 text-white font-semibold rounded-lg shadow-lg hover:bg-red-700 transition duration-150 transform hover:scale-[1.02]">
            <span class="font-bold">+</span> Tambah Banner Baru
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl relative mb-6 shadow-sm">
            <strong class="font-bold">Berhasil!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white p-6 rounded-xl shadow-2xl border border-gray-100 overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-16">ID
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">
                        Pratinjau</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title &
                        Subtitle</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Link & Button
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-20">Urutan
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-24">Status
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-24">Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @if ($carousels->isEmpty())
                    <tr>
                        <td colspan="7" class="px-6 py-10 text-center text-gray-500 text-lg">
                            Belum ada banner yang dibuat. Silakan tambahkan banner baru.
                        </td>
                    </tr>
                @endif

                @foreach ($carousels as $carousel)
                    <tr class="hover:bg-red-50 transition duration-100">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-center text-gray-900">
                            {{ $carousel->id }}</td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            {{-- Tampilkan pratinjau gambar --}}
                            <img src="{{ asset('storage/' . $carousel->image_url) }}" alt="Banner"
                                class="w-28 h-14 object-cover rounded-md shadow-md border border-gray-200">
                        </td>

                        <td class="px-6 py-4 text-sm text-gray-900 max-w-sm truncate">
                            <strong>{{ $carousel->title ?? 'N/A' }}</strong><br>
                            <span class="text-xs text-gray-500">{{ $carousel->subtitle ?? 'Tanpa Subtitle' }}</span>
                        </td>

                        <td class="px-6 py-4 text-sm text-gray-700 max-w-xs">
                            <span class="font-semibold block">{{ $carousel->button_text ?? 'Tombol' }}</span>
                            <span class="text-xs text-blue-500 truncate block">{{ $carousel->button_link ?? '#' }}</span>
                        </td>

                        {{-- Kolom Urutan --}}
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-center text-gray-700">
                            {{ $carousel->order ?? 99 }}
                        </td>

                        {{-- Kolom Status Aktif --}}
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            @if ($carousel->is_active ?? false)
                                {{-- Default ke false jika kolom belum ada --}}
                                <span
                                    class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                            @else
                                <span
                                    class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Draft</span>
                            @endif
                        </td>

                        {{-- Kolom Aksi --}}
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <a href="{{ route('admin.carousels.edit', $carousel) }}"
                                class="text-indigo-600 hover:text-indigo-900 mr-2 p-1 rounded hover:bg-indigo-50 transition">Edit</a>

                            <form action="{{ route('admin.carousels.destroy', $carousel) }}" method="POST"
                                class="inline ml-2"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus banner ini secara permanen?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-red-500 hover:text-red-700 p-1 rounded hover:bg-red-50 transition focus:outline-none">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Pagination --}}
        @if ($carousels->lastPage() > 1)
            <div class="mt-6 flex justify-between items-center border-t pt-4">
                <span class="text-sm text-gray-600">
                    Menampilkan {{ $carousels->firstItem() }} hingga {{ $carousels->lastItem() }} dari total
                    {{ $carousels->total() }} Banner
                </span>
                {{ $carousels->links() }}
            </div>
        @endif
    </div>
@endsection
