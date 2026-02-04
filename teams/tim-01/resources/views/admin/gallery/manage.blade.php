@extends('layouts.admin')

@section('title', 'Kelola Galeri - ' . $destination->name)

@section('header_title', 'Kelola Foto')
@section('header_subtitle')
    Wisata: <span class="font-bold text-green-600">{{ $destination->name }}</span>
@endsection

@section('header_actions')
    <a href="{{ route('admin.gallery.selection') }}" 
       class="flex items-center gap-2 bg-white border border-gray-300 text-gray-600 hover:text-green-700 hover:border-green-500 hover:bg-green-50 px-4 py-2 rounded-lg text-sm font-medium transition-all shadow-sm">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
    </a>
@endsection

@section('content')
    @if($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 mb-8">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Upload Foto Baru</h3>

        <form action="{{ route('admin.gallery.store', $destination->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col md:flex-row gap-4 items-end">
            @csrf
            <div class="flex-1 w-full">
                <label class="block text-sm font-medium text-gray-700 mb-2">Pilih File Gambar (Max 2MB)</label>
                <input type="file" name="image" required class="block w-full text-sm text-gray-500
                    file:mr-4 file:py-2.5 file:px-4
                    file:rounded-lg file:border-0
                    file:text-sm file:font-semibold
                    file:bg-green-50 file:text-green-700
                    hover:file:bg-green-100 cursor-pointer border border-gray-300 rounded-lg
                  "/>
            </div>
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2.5 rounded-lg font-medium shadow-md transition-all flex items-center gap-2">
                <i class="fa-solid fa-cloud-arrow-up"></i> Upload
            </button>
        </form>
    </div>

    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
        <i class="fa-regular fa-images text-gray-500"></i> Koleksi Foto
    </h3>

    @if($destination->images->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($destination->images as $img)
                <div class="group relative bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg transition-all duration-300 {{ $img->is_primary ? 'ring-2 ring-green-500' : '' }}">

                    @if($img->is_primary)
                        <div class="absolute top-2 left-2 z-10 bg-green-600 text-white text-[10px] font-bold px-3 py-1 rounded-full shadow-md flex items-center gap-1">
                            <i class="fa-solid fa-star"></i> THUMBNAIL
                        </div>
                    @endif

                    <div class="aspect-square w-full overflow-hidden bg-gray-100 relative">
                        <img src="{{ asset('storage/' . $img->image_path) }}" 
                             alt="Foto Wisata" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">

                        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-3 backdrop-blur-[2px]">

                            @if(!$img->is_primary)
                                <form action="{{ route('admin.gallery.primary', $img->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <button type="submit" class="w-10 h-10 rounded-full bg-white text-yellow-500 hover:bg-yellow-400 hover:text-white transition shadow-lg flex items-center justify-center transform hover:scale-110" title="Jadikan Thumbnail">
                                        <i class="fa-solid fa-star"></i>
                                    </button>
                                </form>
                            @endif

                            <form action="{{ route('admin.gallery.destroy', $img->id) }}" method="POST" onsubmit="return confirm('Hapus foto ini permanen?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-10 h-10 rounded-full bg-white text-red-500 hover:bg-red-500 hover:text-white transition shadow-lg flex items-center justify-center transform hover:scale-110" title="Hapus Foto">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </form>

                        </div>
                    </div>

                    <div class="p-3 text-xs text-gray-400 text-center border-t border-gray-100 bg-gray-50">
                        <i class="fa-regular fa-clock mr-1"></i> {{ $img->created_at->diffForHumans() }}
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-16 bg-white rounded-2xl border-2 border-dashed border-gray-300">
            <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto text-gray-400 mb-4">
                <i class="fa-regular fa-image text-3xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900">Belum ada foto</h3>
            <p class="text-gray-500 text-sm mt-1">Silakan upload foto pada form di atas.</p>
        </div>
    @endif
@endsection