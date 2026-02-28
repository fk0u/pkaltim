@extends('layouts.admin')

@section('title', 'Edit Kuliner')

@section('content')
<div class="mb-6">
    <div class="flex items-center space-x-2 text-sm text-gray-600 mb-4">
        <a href="{{ route('admin.kuliner.manage') }}" class="hover:text-orange-500">Manage Kuliner</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <span class="text-gray-800 font-medium">Edit Kuliner</span>
    </div>
    <h2 class="text-2xl font-bold text-gray-800">Edit Kuliner</h2>
    <p class="text-gray-600">Perbarui informasi kuliner yang sudah ada.</p>
</div>

<div class="bg-white rounded-lg shadow-md p-6">
    <form action="{{ route('kuliner.update', $kuliner->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Nama Kuliner -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Kuliner <span class="text-red-500">*</span></label>
                <input type="text" name="nama_kuliner" value="{{ old('nama_kuliner', $kuliner->nama_kuliner) }}" required class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500 @error('nama_kuliner') border-red-500 @enderror">
                @error('nama_kuliner')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Asal Daerah -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Asal Daerah <span class="text-red-500">*</span></label>
                <input type="text" name="asal_daerah" value="{{ old('asal_daerah', $kuliner->asal_daerah) }}" required class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500 @error('asal_daerah') border-red-500 @enderror">
                @error('asal_daerah')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Place -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tempat <span class="text-red-500">*</span></label>
                <select name="place_id" required class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500 @error('place_id') border-red-500 @enderror">
                    <option value="">Pilih Tempat</option>
                    @foreach($places as $place)
                        <option value="{{ $place->id }}" {{ old('place_id', $kuliner->place_id) == $place->id ? 'selected' : '' }}>
                            {{ $place->nama_tempat }}
                        </option>
                    @endforeach
                </select>
                @error('place_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi <span class="text-red-500">*</span></label>
                <textarea name="deskripsi" rows="5" required class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500 @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi', $kuliner->deskripsi) }}</textarea>
                @error('deskripsi')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Kategori -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori <span class="text-red-500">*</span></label>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                    @foreach($categories as $category)
                        <label class="flex items-center space-x-2 p-3 border border-gray-300 rounded-lg hover:bg-orange-50 cursor-pointer transition">
                            <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                {{ in_array($category->id, old('categories', $kuliner->categories->pluck('id')->toArray())) ? 'checked' : '' }}
                                class="rounded text-orange-500 focus:ring-orange-500">
                            <span class="text-sm text-gray-700">{{ $category->nama_kategori }}</span>
                        </label>
                    @endforeach
                </div>
                @error('categories')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Current Image -->
            @if($kuliner->external_image_url || $kuliner->gambar)
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Saat Ini</label>
                <div class="relative w-48 h-48 rounded-lg overflow-hidden border border-gray-300">
                    @if($kuliner->external_image_url)
                        <img src="{{ $kuliner->external_image_url }}" alt="{{ $kuliner->nama_kuliner }}" class="w-full h-full object-cover">
                    @elseif($kuliner->gambar)
                        <img src="{{ asset('storage/' . $kuliner->gambar) }}" alt="{{ $kuliner->nama_kuliner }}" class="w-full h-full object-cover">
                    @endif
                </div>
            </div>
            @endif

            <!-- Upload Gambar -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Upload Gambar Baru</label>
                <input type="file" name="gambar" accept="image/*" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500 @error('gambar') border-red-500 @enderror">
                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF (Max: 2MB)</p>
                @error('gambar')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- External Image URL -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Atau URL Gambar External</label>
                <input type="url" name="external_image_url" value="{{ old('external_image_url', $kuliner->external_image_url) }}" placeholder="https://example.com/image.jpg" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500 @error('external_image_url') border-red-500 @enderror">
                @error('external_image_url')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Google Maps URL -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Google Maps URL</label>
                <input type="url" name="google_maps_url" value="{{ old('google_maps_url', $kuliner->google_maps_url) }}" placeholder="https://maps.google.com/..." class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500 @error('google_maps_url') border-red-500 @enderror">
                @error('google_maps_url')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status Halal -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status Halal <span class="text-red-500">*</span></label>
                <div class="flex space-x-4">
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="radio" name="is_halal" value="1" {{ old('is_halal', $kuliner->is_halal) == 1 ? 'checked' : '' }} required class="text-orange-500 focus:ring-orange-500">
                        <span class="text-sm text-gray-700">Halal</span>
                    </label>
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="radio" name="is_halal" value="0" {{ old('is_halal', $kuliner->is_halal) == 0 ? 'checked' : '' }} required class="text-orange-500 focus:ring-orange-500">
                        <span class="text-sm text-gray-700">Non-Halal</span>
                    </label>
                </div>
                @error('is_halal')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Vegetarian -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status Vegetarian</label>
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" name="is_vegetarian" value="1" {{ old('is_vegetarian', $kuliner->is_vegetarian) ? 'checked' : '' }} class="rounded text-orange-500 focus:ring-orange-500">
                    <span class="text-sm text-gray-700">Vegetarian</span>
                </label>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end space-x-3 mt-8 pt-6 border-t border-gray-200">
            <a href="{{ route('admin.kuliner.manage') }}" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Batal</a>
            <button type="submit" class="px-6 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition shadow-md flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
