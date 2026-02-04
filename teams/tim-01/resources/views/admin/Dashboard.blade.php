@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('header_title', 'Panel Dashboard Admin')
@section('header_subtitle')
    Selamat datang kembali, <span
        class="text-active font-semibold">{{ Auth::user()->username ?? Auth::user()->name }}</span>!
@endsection

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div
            class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-6 hover:shadow-md transition-shadow">
            <div class="w-16 h-16 rounded-2xl bg-blue-50 flex items-center justify-center text-active">
                <i class="fa-solid fa-map-location-dot text-2xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Total Destinasi</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $totalDestinations }}</h3>
            </div>
        </div>
        <div
            class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-6 hover:shadow-md transition-shadow">
            <div class="w-16 h-16 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-500">
                <i class="fa-solid fa-comments text-2xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Total Ulasan</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $totalReviews }}</h3>
            </div>
        </div>
        <div
            class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-6 hover:shadow-md transition-shadow">
            <div class="w-16 h-16 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-500">
                <i class="fa-solid fa-image text-2xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Total Gambar</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $totalImage }}</h3>
            </div>
        </div>
        <div
            class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-6 hover:shadow-md transition-shadow">
            <div class="w-16 h-16 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-500">
                <i class="fa-solid fa-list text-2xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Total Kategori</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $totalCategory}}</h3>
            </div>
        </div>
        <div
            class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-6 hover:shadow-md transition-shadow">
            <div class="w-16 h-16 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-500">
                <i class="fa-solid fa-bell-concierge text-2xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Total Fasilitas</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $totalFacility}}</h3>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
        <img src="https://illustrations.popsy.co/gray/creative-work.svg" alt="Empty State"
            class="h-48 mx-auto opacity-50 mb-4">
        <h3 class="text-lg font-medium text-gray-900">Belum ada aktivitas terbaru</h3>
        <p class="text-gray-500">Data terbaru akan muncul di sini.</p>
    </div>
@endsection