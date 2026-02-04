@extends('layouts.admin')

@section('title', 'Pilih Destinasi - Galeri Wisata')

@section('header_title', 'Galeri Wisata')
@section('header_subtitle', 'Pilih destinasi wisata yang ingin Anda kelola fotonya.')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div
            class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-6 hover:shadow-md transition-shadow">
            <div class="w-16 h-16 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-500">
                <i class="fa-solid fa-images text-2xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Total Image</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $totalImage }}</h3>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-bold tracking-wider">
                <tr>
                    <th class="px-6 py-4">Nama Destinasi</th>
                    <th class="px-6 py-4 text-center">Jumlah Foto</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($destinations as $item)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <div class="font-bold text-gray-800 text-lg">{{ $item->name }}</div>
                            <div class="text-xs text-gray-400">
                                <i class="fa-regular fa-clock mr-1"></i> Update: {{ $item->updated_at->format('d M Y') }}
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold shadow-sm">
                                {{ $item->images_count ?? 0 }} Foto
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{-- TOMBOL INI MEMBUKA PAGE MANAGE --}}
                            <a href="{{ route('admin.gallery.index', $item->id) }}"
                                class="bg-active inline-flex items-center gap-2 hover:bg-green-700 text-white px-5 py-2.5 rounded-lg text-sm font-medium shadow-lg shadow-green-500/30 transition-all transform hover:-translate-y-0.5">
                                <i class="fa-regular fa-images"></i> Kelola Foto
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-12 text-center text-gray-500">
                            Belum ada data destinasi. Silakan tambahkan destinasi terlebih dahulu.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection