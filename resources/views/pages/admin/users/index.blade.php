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

                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            {{-- Form Toggle Role Admin --}}
                            <form action="{{ route('admin.users.toggle-admin', $user) }}" method="POST" class="inline">
                                @csrf

                                {{-- Logika untuk mencegah Admin mengubah statusnya sendiri --}}
                                @if ($user->id !== Auth::id())
                                    @if ($user->is_admin)
                                        <button type="submit" class="text-red-600 hover:text-red-900 focus:outline-none">
                                            Turunkan ke Pengguna
                                        </button>
                                    @else
                                        <button type="submit"
                                            class="text-green-600 hover:text-green-900 focus:outline-none">
                                            Promosikan ke Admin
                                        </button>
                                    @endif
                                @else
                                    <span class="text-gray-400">Anda</span>
                                @endif
                            </form>
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
