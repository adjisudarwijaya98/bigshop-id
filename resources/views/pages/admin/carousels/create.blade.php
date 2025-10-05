@extends('layouts.admin_dashboard_layout')

@section('title', 'Tambah Banner Baru')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Tambah Banner Carousel Baru</h1>

    {{-- LIVE PREVIEW SECTION --}}
    <div class="mb-8 p-6 bg-red-50 rounded-lg shadow-inner">
        <h2 class="text-xl font-semibold mb-4 text-red-800">Pratinjau Banner</h2>

        {{-- Hapus background-image statis. Gambar sepenuhnya ditangani oleh tag <img id="preview-image"> di bawah. --}}
        <div id="carousel-preview" class="relative w-full h-64 md:h-80 overflow-hidden rounded-lg shadow-xl bg-gray-200">

            {{-- Gambar akan diisi oleh JS, awalnya menggunakan placeholder --}}
            <img id="preview-image" src="https://placehold.co/1200x400/FEE2E2/DC2626?text=Pilih+Gambar+Untuk+Pratinjau"
                alt="Banner Preview" class="w-full h-full object-cover transition duration-300 ease-in-out">

            {{-- Overlay Teks --}}
            <div
                class="absolute inset-0 bg-black bg-opacity-40 flex flex-col justify-center items-start p-6 sm:p-12 text-white">
                <h2 id="preview-title" class="text-2xl md:text-4xl font-extrabold mb-2 leading-tight">Judul Banner Akan
                    Muncul Di Sini</h2>
                <p id="preview-subtitle" class="text-sm md:text-lg mb-4 opacity-90 max-w-lg">Subjudul atau deskripsi singkat
                    yang menarik perhatian pengunjung.</p>
                <a id="preview-button" href="#"
                    class="px-5 py-2 bg-red-600 font-bold rounded-full shadow-lg hover:bg-red-700 transition duration-300 transform hover:scale-105">
                    Teks Tombol
                </a>
            </div>
        </div>
    </div>
    {{-- END LIVE PREVIEW SECTION --}}

    <div class="bg-white p-6 rounded-lg shadow-md border max-w-2xl">
        <form action="{{ route('admin.carousels.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- INPUT: File Gambar --}}
            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700">Gambar Banner (Wajib)</label>
                <input type="file" name="image" id="image" required
                    class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                @error('image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- INPUT: Title (Wajib) --}}
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Judul Banner (Wajib)</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- INPUT: Subtitle --}}
            <div class="mb-4">
                <label for="subtitle" class="block text-sm font-medium text-gray-700">Subjudul (Deskripsi Singkat)</label>
                <input type="text" name="subtitle" id="subtitle" value="{{ old('subtitle') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                @error('subtitle')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- INPUT: Button Text --}}
            <div class="mb-4">
                <label for="button_text" class="block text-sm font-medium text-gray-700">Teks Tombol (Misal: Belanja
                    Sekarang)</label>
                <input type="text" name="button_text" id="button_text" value="{{ old('button_text') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                @error('button_text')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- INPUT: Button Link --}}
            <div class="mb-4">
                <label for="button_link" class="block text-sm font-medium text-gray-700">Link Tujuan (URL)</label>
                <input type="url" name="button_link" id="button_link" value="{{ old('button_link') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                @error('button_link')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6">
                <button type="submit"
                    class="px-4 py-2 bg-red-600 text-white font-semibold rounded-md shadow-md hover:bg-red-700 transition duration-150">
                    Simpan Banner
                </button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Elemen-elemen Preview
            const previewTitle = document.getElementById('preview-title');
            const previewSubtitle = document.getElementById('preview-subtitle');
            const previewButton = document.getElementById('preview-button');
            const previewImage = document.getElementById('preview-image');
            const imageInput = document.getElementById('image');

            // Placeholder Gambar Default
            const defaultPlaceholderImage =
                'https://placehold.co/1200x400/FEE2E2/DC2626?text=Pilih+Gambar+Untuk+Pratinjau';

            // Elemen-elemen Input
            const titleInput = document.getElementById('title');
            const subtitleInput = document.getElementById('subtitle');
            const buttonTextInput = document.getElementById('button_text');
            const buttonLinkInput = document.getElementById('button_link');

            // Nilai Default
            const defaultTitle = 'Judul Banner Akan Muncul Di Sini';
            const defaultSubtitle = 'Subjudul atau deskripsi singkat yang menarik perhatian pengunjung.';
            const defaultButtonText = 'Teks Tombol';
            const defaultButtonLink = '#';

            // Fungsi Pembaruan Teks
            function updateTextPreview(event) {
                const target = event.target;

                // Gunakan trim() dan fallback ke nilai default jika input kosong
                if (target === titleInput) {
                    previewTitle.textContent = target.value.trim() || defaultTitle;
                } else if (target === subtitleInput) {
                    previewSubtitle.textContent = target.value.trim() || defaultSubtitle;
                } else if (target === buttonTextInput) {
                    previewButton.textContent = target.value.trim() || defaultButtonText;
                } else if (target === buttonLinkInput) {
                    previewButton.href = target.value.trim() || defaultButtonLink;
                }
            }

            // Fungsi Pembaruan Gambar
            function updateImagePreview(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        // Pastikan gambar pratinjau selalu terlihat
                        previewImage.style.display = 'block';
                    }
                    reader.readAsDataURL(file);
                } else {
                    // Kembali ke placeholder jika file dibatalkan/dihapus
                    previewImage.src = defaultPlaceholderImage;
                    previewImage.style.display = 'block'; // Pastikan placeholder juga terlihat
                }
            }

            // Event Listeners
            titleInput.addEventListener('input', updateTextPreview);
            subtitleInput.addEventListener('input', updateTextPreview);
            buttonTextInput.addEventListener('input', updateTextPreview);
            buttonLinkInput.addEventListener('input', updateTextPreview);
            imageInput.addEventListener('change', updateImagePreview);

            // Inisialisasi Preview saat halaman dimuat (jika ada nilai old())
            [titleInput, subtitleInput, buttonTextInput, buttonLinkInput].forEach(input => {
                if (input.value) {
                    updateTextPreview({
                        target: input
                    });
                }
            });

            // Inisialisasi gambar pada saat load
            updateImagePreview({
                target: imageInput
            });
        });
    </script>
@endsection
