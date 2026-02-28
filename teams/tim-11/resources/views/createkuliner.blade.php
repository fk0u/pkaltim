@extends('layouts.admin')

@section('title', 'Tambah Kuliner')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Tambah Kuliner Baru</h2>
    <p class="text-gray-600">Isi form berikut untuk menambahkan data kuliner baru.</p>
</div>

<div class="bg-white rounded-lg shadow-md p-6">
    <form action="{{ route('kuliner.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Left Column -->
            <div class="space-y-6">
                <!-- Nama Kuliner -->
                <div>
                    <label for="nama_kuliner" class="block text-sm font-medium text-gray-700 mb-1">Nama Kuliner</label>
                    <input type="text" name="nama_kuliner" id="nama_kuliner" class="w-full rounded-lg border-gray-300 focus:border-orange-500 focus:ring focus:ring-orange-200 transition duration-200 p-2 border" placeholder="Contoh: Nasi Kuning" required>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4" class="w-full rounded-lg border-gray-300 focus:border-orange-500 focus:ring focus:ring-orange-200 transition duration-200 p-2 border" placeholder="Deskripsi lengkap kuliner..." required></textarea>
                </div>

                <!-- Asal Daerah -->
                <div>
                    <label for="asal_daerah" class="block text-sm font-medium text-gray-700 mb-1">Asal Daerah</label>
                    <input type="text" name="asal_daerah" id="asal_daerah" class="w-full rounded-lg border-gray-300 focus:border-orange-500 focus:ring focus:ring-orange-200 transition duration-200 p-2 border" placeholder="Contoh: Samarinda" required>
                </div>

                <!-- Google Maps URL -->
                <div>
                    <label for="google_maps_url" class="block text-sm font-medium text-gray-700 mb-1">Google Maps URL</label>
                    <input type="url" name="google_maps_url" id="google_maps_url" class="w-full rounded-lg border-gray-300 focus:border-orange-500 focus:ring focus:ring-orange-200 transition duration-200 p-2 border" placeholder="https://maps.google.com/...">
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-6">
                <!-- Place -->
                <div>
                    <label for="place_id" class="block text-sm font-medium text-gray-700 mb-1">Tempat</label>
                    <select name="place_id" id="place_id" class="w-full rounded-lg border-gray-300 focus:border-orange-500 focus:ring focus:ring-orange-200 transition duration-200 p-2 border" required>
                        <option value="">Pilih Tempat</option>
                        @foreach($places as $place)
                            <option value="{{ $place->id }}">{{ $place->nama_tempat }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Kategori -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                    <div class="grid grid-cols-2 gap-2 max-h-40 overflow-y-auto border p-2 rounded-lg">
                        @foreach($categories as $category)
                            <div class="flex items-center">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}" id="cat_{{ $category->id }}" class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300 rounded">
                                <label for="cat_{{ $category->id }}" class="ml-2 block text-sm text-gray-900">
                                    {{ $category->nama_kategori }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Gambar Source Toggle -->
                <div x-data="{ sourceType: 'file' }">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Foto Makanan</label>
                    <div class="flex items-center space-x-4 mb-3">
                        <label class="inline-flex items-center">
                            <input type="radio" name="image_source" value="file" x-model="sourceType" class="form-radio text-orange-600" checked>
                            <span class="ml-2">Upload File</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="image_source" value="url" x-model="sourceType" class="form-radio text-orange-600">
                            <span class="ml-2">URL External</span>
                        </label>
                    </div>

                    <!-- Upload File -->
                    <div x-show="sourceType === 'file'">
                        <input type="file" name="gambar" id="gambar" class="w-full rounded-lg border-gray-300 focus:border-orange-500 focus:ring focus:ring-orange-200 transition duration-200 p-2 border">
                        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF. Maks: 2MB.</p>
                    </div>

                    <!-- URL Input -->
                    <div x-show="sourceType === 'url'" style="display: none;">
                        <input type="url" name="external_image_url" id="external_image_url" class="w-full rounded-lg border-gray-300 focus:border-orange-500 focus:ring focus:ring-orange-200 transition duration-200 p-2 border" placeholder="https://example.com/image.jpg">
                    </div>
                </div>

                <!-- Options -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Opsi Tambahan</label>
                    <div class="space-y-2">
                        <!-- Halal Status -->
                        <div class="flex items-center space-x-4">
                            <span class="text-sm text-gray-600">Status Halal:</span>
                            <label class="inline-flex items-center">
                                <input type="radio" name="is_halal" value="1" class="form-radio text-green-600" checked>
                                <span class="ml-2">Halal</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="is_halal" value="0" class="form-radio text-red-600">
                                <span class="ml-2">Non-Halal</span>
                            </label>
                        </div>

                        <!-- Vegetarian -->
                        <div class="flex items-center mt-2">
                            <input type="checkbox" name="is_vegetarian" id="is_vegetarian" class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                            <label for="is_vegetarian" class="ml-2 block text-sm text-gray-900">
                                Vegetarian Friendly
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 flex justify-end space-x-3 pt-6 border-t">
            <a href="{{ route('admin.kuliner.manage') }}" class="px-6 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition">Batal</a>
            <button type="submit" class="px-6 py-2 rounded-lg bg-orange-500 text-white hover:bg-orange-600 transition shadow-md">Simpan Kuliner</button>
        </div>
    </form>
</div>

<!-- Alpine.js for interactivity -->
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
@endsection