@extends('layouts.admin_dashboard_layout')

@section('title', 'Manajemen Semua Pengguna')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Manajemen Semua Pengguna</h1>

    <div class="bg-white p-6 rounded-lg shadow-md border overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Peran (Role)
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Daftar
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($users as $user)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $user->email }}</td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($user->is_admin)
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">ADMIN</span>
                            @elseif ($user->umkmProfile)
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">UMKM</span>
                            @else
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Pelanggan</span>
                            @endif
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $user->created_at?->format('Y-m-d') ?? 'N/A' }}
                        </td>

                        {{-- Kolom Aksi diperbarui untuk tampilan yang lebih rapi --}}
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex space-x-2 items-center">

                            {{-- Form Toggle Role Admin/Pengguna --}}
                            <form action="{{ route('admin.users.toggle-admin', $user) }}" method="POST" class="inline">
                                @csrf

                                {{-- Logika untuk mencegah Admin mengubah statusnya sendiri --}}
                                @if ($user->id !== Auth::id())
                                    @if ($user->is_admin)
                                        <button type="submit"
                                            class="px-2 py-1 text-xs font-semibold rounded-md bg-red-100 text-red-700 hover:bg-red-200 transition focus:outline-none">
                                            Turunkan
                                        </button>
                                    @else
                                        <button type="submit"
                                            class="px-2 py-1 text-xs font-semibold rounded-md bg-green-100 text-green-700 hover:bg-green-200 transition focus:outline-none">
                                            Promosikan
                                        </button>
                                    @endif
                                @else
                                    <span class="px-2 py-1 text-xs text-gray-400">Anda (Saat Ini)</span>
                                @endif
                            </form>

                            @if ($user->id !== Auth::id())
                                {{-- Tombol untuk membuka Modal Hapus --}}
                                <button type="button"
                                    class="px-2 py-1 text-xs font-semibold rounded-md bg-red-600 text-white hover:bg-red-700 transition focus:outline-none"
                                    onclick="document.getElementById('delete-modal-{{ $user->id }}').showModal()">
                                    Hapus
                                </button>
                            @endif

                            {{-- Modal Konfirmasi Penghapusan (Menggunakan elemen <dialog>) --}}
                            <dialog id="delete-modal-{{ $user->id }}"
                                class="p-6 rounded-lg shadow-xl backdrop:bg-black/50 w-96 max-w-full">
                                <div class="text-left">
                                    <h3 class="text-xl font-bold text-gray-800 mb-3">Konfirmasi Penghapusan</h3>
                                    <p class="text-gray-700 mb-6">Apakah Anda yakin ingin menghapus pengguna
                                        <strong>{{ $user->name }} (ID: {{ $user->id }})</strong>? Aksi ini akan
                                        menghapus **semua produk dan data UMKM** yang terkait dan tidak dapat dibatalkan.
                                    </p>

                                    <div class="flex justify-end space-x-3">
                                        {{-- Tombol Batal --}}
                                        <button type="button"
                                            onclick="document.getElementById('delete-modal-{{ $user->id }}').close()"
                                            class="px-4 py-2 text-sm font-medium bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                                            Batal
                                        </button>

                                        {{-- Form Hapus yang sebenarnya (disubmit dari modal) --}}
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                            class="inline" id="delete-form-{{ $user->id }}">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="px-4 py-2 text-sm font-medium bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                                                Ya, Hapus Pengguna
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </dialog>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>

@endsection
