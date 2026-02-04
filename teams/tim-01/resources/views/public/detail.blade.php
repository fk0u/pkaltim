@extends('layouts.app')

@section('title', $destination->name . ' - WisataKaltim')

@section('content')
    <div class="relative w-full h-[85vh] min-h-[600px] bg-gray-900 overflow-hidden">
        @php
            // Default image
            $heroImage = 'https://images.unsplash.com/photo-1596401057633-565652f56878?ixlib=rb-4.0.3';

            // Cek jika ada foto di database (pakai 'image_path' sesuai DB)
            if ($destination->images && $destination->images->count() > 0) {
                $heroImage = asset('storage/' . $destination->images->first()->image_path);
            }

            // Hitung Rating (Hanya yang approved jika perlu)
            // Menggunakan collection filter agar aman
            $approvedReviews = $destination->reviews->where('status', 'approved');
            $avgRating = $approvedReviews->avg('rating') ?? 0;
            $totalReviews = $approvedReviews->count();
        @endphp

        <img src="{{ $heroImage }}" alt="{{ $destination->name }}"
            class="absolute inset-0 w-full h-full object-cover opacity-90">

        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></div>

        <div class="absolute inset-0 flex flex-col justify-end pb-20">
            <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 relative">
                <div class="mb-6 flex items-center space-x-3 text-sm font-medium text-white/80">
                    <span class="bg-white/10 backdrop-blur-md border border-white/20 px-3 py-1 rounded-full text-white">
                        <i class="fa-solid fa-location-dot mr-2 text-[#22c55e]"></i>
                        {{ $destination->address ?? 'Lokasi Belum Diisi' }}
                    </span>
                    <span class="hidden md:inline">/</span>
                    <span class="text-[#22c55e] hidden md:inline">{{ $destination->category->name ?? 'Umum' }}</span>
                </div>

                <h1 class="text-5xl md:text-7xl font-bold text-white mb-4 tracking-tight leading-tight">
                    {{ $destination->name }}
                </h1>
                

                <div class="flex flex-col md:flex-row md:items-center gap-6 text-white/90">
                    <div
                        class="flex items-center gap-3 bg-white/10 backdrop-blur-sm px-4 py-2 rounded-2xl border border-white/10">
                        <i class="fa-solid fa-star text-yellow-400 text-xl"></i>
                        <div>
                            <span class="text-xl font-bold text-white">{{ number_format($avgRating, 1) }}</span>
                            <span class="text-xs text-gray-300 block leading-none">dari {{ $totalReviews }} ulasan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20 bg-[#F8F9FA]">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12">

            <div class="lg:col-span-2 space-y-12">

                <section>
                    <h2 class="text-2xl font-bold text-[#0B3B2D] mb-6 flex items-center gap-3">
                        <span class="w-8 h-1 bg-[#22c55e] rounded-full"></span>
                        Tentang Destinasi
                    </h2>
                    <div class="prose prose-lg text-gray-600 leading-relaxed text-justify">
                        {!! nl2br(e($destination->description)) !!}
                    </div>
                </section>

                <section>
                    <h2 class="text-2xl font-bold text-[#0B3B2D] mb-6 flex items-center gap-3">
                        <span class="w-8 h-1 bg-[#22c55e] rounded-full"></span>
                        Fasilitas
                    </h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        {{-- Gunakan forelse untuk jaga-jaga kalau kosong --}}
                        @forelse($destination->facilities as $facility)
                            <div
                                class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex flex-col items-center justify-center gap-3 hover:shadow-md transition-shadow group">
                                <div
                                    class="w-12 h-12 rounded-full bg-[#ecfdf5] flex items-center justify-center text-[#105e43] group-hover:bg-[#0B3B2D] group-hover:text-white transition-colors duration-300">
                                    {{-- PERBAIKAN: Gunakan object syntax (->) dan nama kolom 'icon_class' --}}
                                    <i class="fa-solid {{ $facility->icon_class ?? 'fa-check' }} text-lg"></i>
                                </div>
                                {{-- PERBAIKAN: Gunakan object syntax (->) dan nama kolom 'name' --}}
                                <span class="text-sm font-medium text-gray-700 text-center">{{ $facility->name }}</span>
                            </div>
                        @empty
                            <p class="text-gray-500 col-span-4">Belum ada data fasilitas.</p>
                        @endforelse
                    </div>
                </section>

                <section>
                    <h2 class="text-2xl font-bold text-[#0B3B2D] mb-6 flex items-center gap-3">
                        <span class="w-8 h-1 bg-[#22c55e] rounded-full"></span>
                        Galeri Foto
                    </h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @forelse($destination->images as $img)
                            <div class="relative group overflow-hidden rounded-xl shadow-sm h-48 md:h-64 cursor-pointer">
                                <img src="{{ asset('storage/' . $img->image_path) }}" alt="Galeri {{ $destination->name }}"
                                    class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">

                                <div
                                    class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
                                    <i class="fa-solid fa-magnifying-glass-plus text-white text-3xl"></i>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 col-span-3 italic">Belum ada foto galeri.</p>
                        @endforelse
                    </div>
                </section>

                <section>
                    <h2 class="text-2xl font-bold text-[#0B3B2D] mb-6 flex items-center gap-3">
                        <span class="w-8 h-1 bg-[#22c55e] rounded-full"></span>
                        Lokasi Maps
                    </h2>
                    <div class="w-full h-80 bg-gray-200 rounded-2xl overflow-hidden relative shadow-inner">
                        @php
                            $mapQuery = $destination->address ?? 'Kalimantan Timur';
                            if ($destination->latitude && $destination->longitude) {
                                $mapQuery = $destination->latitude . ',' . $destination->longitude;
                            }
                        @endphp
                        <iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                            src="https://maps.google.com/maps?q={{ urlencode($mapQuery) }}&t=&z=13&ie=UTF8&iwloc=&output=embed">
                        </iframe>
                    </div>
                </section>

                <section>
                    <h2 class="text-2xl font-bold text-[#0B3B2D] mb-6 flex items-center gap-3">
                        <span class="w-8 h-1 bg-[#22c55e] rounded-full"></span>
                        Ulasan Pengunjung
                    </h2>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('reviewed_' . $destination->id))
                        <div class="bg-green-50 border border-green-200 rounded-2xl p-8 text-center mb-12">
                            <div
                                class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fa-solid fa-check text-2xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Terima Kasih!</h3>
                            <p class="text-gray-600">Ulasan Anda telah kami terima dan sedang menunggu persetujuan admin.</p>
                        </div>
                    @else
                        <form action="{{ route('review.store', $destination->id) }}" method="POST"
                            class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm mb-12">
                            @csrf
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Anda</label>
                                    <input type="text" name="visitor_name" 
                                           value="{{ Auth::check() ? (Auth::user()->username ?? Auth::user()->name) : '' }}" 
                                           {{ Auth::check() ? 'readonly' : '' }}
                                           required
                                           class="w-full rounded-xl border-gray-300 p-2 border {{ Auth::check() ? 'bg-gray-100 text-gray-500 cursor-not-allowed' : '' }}">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
                                    <select name="rating" required class="w-full rounded-xl border-gray-300 p-2 border">
                                        <option value="5">⭐⭐⭐⭐⭐ (Sangat Bagus)</option>
                                        <option value="4">⭐⭐⭐⭐ (Bagus)</option>
                                        <option value="3">⭐⭐⭐ (Cukup)</option>
                                        <option value="2">⭐⭐ (Kurang)</option>
                                        <option value="1">⭐ (Sangat Kurang)</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Komentar</label>
                                    <textarea name="comment" rows="4" required
                                        class="w-full rounded-xl border-gray-300 p-2 border"></textarea>
                                </div>
                                <button type="submit"
                                    class="w-full bg-[#0B3B2D] text-white font-bold py-3 px-6 rounded-xl hover:bg-[#072d22]">
                                    Kirim Ulasan
                                </button>
                            </div>
                        </form>
                    @endif

                    <div class="space-y-6">
                        @foreach($approvedReviews as $review)
                            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex gap-4">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($review->visitor_name) }}&background=0B3B2D&color=fff"
                                    class="w-12 h-12 rounded-full object-cover shadow-sm">
                                <div>
                                    <h4 class="font-bold text-gray-900">{{ $review->visitor_name }}</h4>
                                    <div class="flex items-center gap-2 text-xs text-gray-500 mb-2">
                                        <span class="flex text-yellow-400">
                                            @for($i = 0; $i < $review->rating; $i++) <i class="fa-solid fa-star"></i> @endfor
                                        </span>
                                        <span>• {{ $review->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-gray-600 text-sm leading-relaxed">"{{ $review->comment }}"</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>

            <div class="lg:col-span-1">
                <aside class="sticky top-6 space-y-6">

                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                        <h4 class="font-bold text-gray-900 mb-4 text-lg">Informasi Kunjungan</h4>
                        <ul class="space-y-4">
                            <li class="flex items-center gap-3 text-sm text-gray-600">
                                <div
                                    class="w-8 h-8 rounded-full bg-green-50 flex items-center justify-center text-[#22c55e] flex-shrink-0">
                                    <i class="fa-solid fa-tag text-xs"></i>
                                </div>
                                <div>
                                    <span class="block text-xs text-gray-400">Harga Tiket</span>
                                    <span class="font-bold text-gray-800">
                                        Rp {{ number_format($destination->price, 0, ',', '.') }}
                                    </span>
                                    @if($destination->price_note)
                                        <span class="text-xs text-gray-500">({{ $destination->price_note }})</span>
                                    @endif
                                </div>
                            </li>

                            <li class="flex items-center gap-3 text-sm text-gray-600">
                                <div
                                    class="w-8 h-8 rounded-full bg-green-50 flex items-center justify-center text-[#22c55e] flex-shrink-0">
                                    <i class="fa-solid fa-clock text-xs"></i>
                                </div>
                                <div>
                                    <span class="block text-xs text-gray-400">Jam Operasional</span>
                                    <span class="font-bold text-gray-800">
                                        {{ $destination->opening_hours ?? 'Setiap Hari' }}
                                    </span>
                                </div>
                            </li>

                            <li class="flex items-center gap-3 text-sm text-gray-600">
                                <div
                                    class="w-8 h-8 rounded-full bg-green-50 flex items-center justify-center text-[#22c55e] flex-shrink-0">
                                    <i class="fa-solid fa-info-circle text-xs"></i>
                                </div>
                                <div>
                                    <span class="block text-xs text-gray-400">Status</span>
                                    <span
                                        class="font-bold {{ $destination->status == 'active' ? 'text-green-600' : 'text-red-500' }}">
                                        {{ $destination->status == 'active' ? 'Buka / Aktif' : 'Tutup Sementara' }}
                                    </span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </aside>
            </div>

        </div>
    </div>
@endsection