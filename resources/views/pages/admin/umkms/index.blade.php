@extends('layouts.admin_dashboard_layout')

@section('title', 'Manajemen Mitra UMKM')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Daftar Mitra UMKM</h1>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4">
        <a href="{{ route('admin.umkms.create') }}"
            class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
            + Tambah UMKM Baru
        </a>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow-md">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Toko</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pemilik
                        (User)</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telepon</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Akun
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bergabung
                        Sejak</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($umkms as $umkm)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-red-600">
                            {{ $umkm->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ $umkm->user->name }} ({{ $umkm->user->email }})
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ $umkm->phone_number ?? '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{-- Tampilkan badge status is_active --}}
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @if ($umkm->is_active) bg-green-100 text-green-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ $umkm->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $umkm->created_at?->format('d M Y') ?? '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            {{-- TOMBOL AKSI TOGGLE STATUS --}}
                            <form action="{{ route('admin.umkms.toggle_status', $umkm) }}" method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin MENGUBAH status UMKM ini?')">
                                @csrf
                                <button type="submit"
                                    class="px-3 py-1 text-xs font-semibold rounded-md transition duration-150 ease-in-out
                                    @if ($umkm->is_active) bg-red-500 text-white hover:bg-red-600
                                    @else 
                                        bg-green-500 text-white hover:bg-green-600 @endif">
                                    {{ $umkm->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                            Belum ada mitra UMKM yang terdaftar.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $umkms->links() }}
    </div>

@endsection
