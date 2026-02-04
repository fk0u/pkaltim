@extends('layouts.app')

@section('title', 'WisataKaltim')

@section('content')
    <!-- Hero Section -->
    <!-- Added -mt-20 to pull hero up behind the fixed navbar (counteracting main's pt-20) -->
    <header class="relative pt-32 pb-32 md:pt-48 md:pb-40 overflow-hidden -mt-20">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?q=80&w=1948&auto=format&fit=crop"
                alt="Kalimantan Nature" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-b from-gray-900/70 via-gray-900/50 to-[#F8F9FA] dark:to-gray-900">
            </div>
        </div>

        <div class="container mx-auto px-4 relative z-10 text-center">

            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight" data-aos="fade-up">
                Jelajahi Wisata Alam<br> <span class="text-brand-500">Kalimantan Timur</span>
            </h1>
            <p class="text-gray-200 text-lg max-w-2xl mx-auto mb-10 font-light leading-relaxed" data-aos="fade-up"
                data-aos-delay="100">
                Jelajahi keindahan alam dan budaya Kalimantan Timur, mulai dari pesona bawah laut Kepulauan Derawan hingga
                tradisi unik Desa Pampang.
                Dapatkan informasi lengkap mengenai lokasi, harga tiket, dan fasilitas terkini untuk merencanakan perjalanan
                Anda di Kalimantan Timur.
            </p>
        </div>
    </header>

    <!-- Main Content Wrapper (was <main>) -->
    <div class="container mx-auto px-4 md:px-8 pb-20 -mt-20 relative z-20 space-y-20">

        <!-- Features Grid -->
        <section>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div data-aos="fade-up" data-aos-delay="0"
                    class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-xl shadow-gray-200/50 dark:shadow-none hover:-translate-y-1 transition duration-300 border border-gray-100 dark:border-gray-700 flex flex-col items-center justify-center gap-3 h-44 group cursor-pointer">
                    <div
                        class="w-12 h-12 bg-brand-50 dark:bg-brand-900/30 rounded-2xl flex items-center justify-center text-brand-600 dark:text-brand-500 group-hover:bg-brand-500 group-hover:text-white transition">
                        <i class="fa-solid fa-tree text-2xl"></i>
                    </div>
                    <span class="font-semibold text-gray-700 dark:text-gray-300">Jelajah Hutan</span>
                </div>
                <div data-aos="fade-up" data-aos-delay="100"
                    class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-xl shadow-gray-200/50 dark:shadow-none hover:-translate-y-1 transition duration-300 border border-gray-100 dark:border-gray-700 flex flex-col items-center justify-center gap-3 h-44 group cursor-pointer">
                    <div
                        class="w-12 h-12 bg-brand-50 dark:bg-brand-900/30 rounded-2xl flex items-center justify-center text-brand-600 dark:text-brand-500 group-hover:bg-brand-500 group-hover:text-white transition">
                        <i class="fa-solid fa-umbrella-beach text-2xl"></i>
                    </div>
                    <span class="font-semibold text-gray-700 dark:text-gray-300">Wisata Bahari</span>
                </div>
                <div data-aos="fade-up" data-aos-delay="200"
                    class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-xl shadow-gray-200/50 dark:shadow-none hover:-translate-y-1 transition duration-300 border border-gray-100 dark:border-gray-700 flex flex-col items-center justify-center gap-3 h-44 group cursor-pointer">
                    <div
                        class="w-12 h-12 bg-brand-50 dark:bg-brand-900/30 rounded-2xl flex items-center justify-center text-brand-600 dark:text-brand-500 group-hover:bg-brand-500 group-hover:text-white transition">
                        <i class="fa-solid fa-paw text-2xl"></i>
                    </div>
                    <span class="font-semibold text-gray-700 dark:text-gray-300">Dunia Satwa</span>
                </div>
                <div data-aos="fade-up" data-aos-delay="300"
                    class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-xl shadow-gray-200/50 dark:shadow-none hover:-translate-y-1 transition duration-300 border border-gray-100 dark:border-gray-700 flex flex-col items-center justify-center gap-3 h-44 group cursor-pointer">
                    <div
                        class="w-12 h-12 bg-brand-50 dark:bg-brand-900/30 rounded-2xl flex items-center justify-center text-brand-600 dark:text-brand-500 group-hover:bg-brand-500 group-hover:text-white transition">
                        <i class="fa-solid fa-sailboat text-2xl"></i>
                    </div>
                    <span class="font-semibold text-gray-700 dark:text-gray-300">Susur Sungai</span>
                </div>
            </div>
        </section>

        <!-- Ionic Destinations -->
        <section>
            <div class="flex justify-between items-end mb-8">
                <div data-aos="fade-right">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Destinasi</h2>
                </div>
                <a href="{{ route('destination.index') }}" data-aos="fade-left"
                    class="flex text-brand-500 dark:text-brand-400 font-semibold hover:underline items-center gap-1 group">
                    Lihat Semua <svg class="w-4 h-4 group-hover:translate-x-1 transition" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                @foreach($destinations as $item)
                    <div data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}"
                        class="bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-lg border border-gray-100 dark:border-gray-700 group hover:shadow-xl transition duration-300 relative">

                        <!-- Stretched Link -->
                        <a href="{{ route('destination.show', $item->slug) }}" class="absolute inset-0 z-10"
                            aria-label="Lihat {{ $item->name }}"></a>

                        <div class="relative h-56 overflow-hidden">
                            @php
                                $imagePath = $item->thumbnail;
                            @endphp

                            <img src="{{ $imagePath }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition duration-700"
                                alt="{{ $item->name }}">

                            <div
                                class="absolute top-4 right-4 bg-white/90 dark:bg-gray-900/90 backdrop-blur px-2.5 py-1 rounded-lg text-xs font-bold shadow-sm flex items-center gap-1 relative z-20">
                                <svg class="w-3 h-3 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                {{ $item->rating ?? 'New' }}
                            </div>
                        </div>

                        <div class="p-5">
                            <p class="text-xs text-brand-500 font-semibold mb-1 uppercase tracking-wide">
                                {{ $item->location ?? 'Kalimantan Timur' }}
                            </p>

                            <h3
                                class="font-bold text-gray-900 dark:text-white text-lg mb-4 group-hover:text-brand-500 transition line-clamp-1">
                                <a href="{{ route('destination.show', $item->slug) }}">
                                    {{ $item->name }}
                                </a>
                            </h3>

                            <div class="flex justify-between items-center pt-4 border-t border-gray-100 dark:border-gray-700">
                                <div>
                                    <p class="text-xs text-gray-400">Mulai dari</p>
                                    <span class="text-brand-600 dark:text-brand-400 font-bold text-lg">
                                        Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </span>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Photo Slider Section -->
        @if($galleryImages->count() > 0)
            <section x-data="{ activeSlide: 0, slides: [
                                                                    @foreach($galleryImages as $img)
                                                                        '{{ asset('storage/' . $img->image_path) }}',
                                                                    @endforeach
                                                                ], interval: null }"
                x-init="interval = setInterval(() => { activeSlide = activeSlide === slides.length - 1 ? 0 : activeSlide + 1 }, 5000)"
                class="mb-10" data-aos="fade-up">
                <div class="mb-10 text-center">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Galeri Wisata</h2>
                </div>

                <div
                    class="relative w-full h-[400px] md:h-[500px] rounded-3xl overflow-hidden shadow-2xl group border border-gray-100 dark:border-gray-800">
                    <!-- Slides -->
                    <template x-for="(slide, index) in slides" :key="index">
                        <div x-show="activeSlide === index" x-transition:enter="transition transform duration-700 ease-out"
                            x-transition:enter-start="opacity-0 scale-105" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition transform duration-700 ease-in"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            class="absolute inset-0">
                            <img :src="slide" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900/60 to-transparent"></div>
                        </div>
                    </template>

                    <!-- Navigation Buttons -->
                    <button
                        @click="clearInterval(interval); activeSlide = activeSlide === 0 ? slides.length - 1 : activeSlide - 1"
                        class="absolute left-6 top-1/2 -translate-y-1/2 bg-white/10 hover:bg-white/30 backdrop-blur-md text-white p-3 rounded-full transition opacity-0 group-hover:opacity-100 border border-white/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    <button
                        @click="clearInterval(interval); activeSlide = activeSlide === slides.length - 1 ? 0 : activeSlide + 1"
                        class="absolute right-6 top-1/2 -translate-y-1/2 bg-white/10 hover:bg-white/30 backdrop-blur-md text-white p-3 rounded-full transition opacity-0 group-hover:opacity-100 border border-white/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>

                    <!-- Indicators -->
                    <div
                        class="absolute bottom-8 left-1/2 -translate-x-1/2 flex space-x-2 bg-black/20 backdrop-blur-sm p-2 rounded-full border border-white/10">
                        <template x-for="(slide, index) in slides" :key="index">
                            <button @click="clearInterval(interval); activeSlide = index"
                                :class="{'bg-brand-500 w-8': activeSlide === index, 'bg-white/50 w-2 hover:bg-white': activeSlide !== index}"
                                class="h-2 rounded-full transition-all duration-300"></button>
                        </template>
                    </div>
                </div>
            </section>
        @endif

        <!-- FAQ Section -->
        <section>
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Pertanyaan Umum</h2>
            </div>

            <div class="max-w-3xl mx-auto space-y-4" x-data="{ selected: null }">
                <!-- FAQ Item 1 -->
                <div data-aos="fade-up" data-aos-delay="100"
                    class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-md">
                    <button @click="selected !== 0 ? selected = 0 : selected = null"
                        class="w-full px-6 py-5 text-left flex justify-between items-center focus:outline-none">
                        <span class="font-bold text-gray-900 dark:text-gray-100 text-lg">Bagaimana akses transportasi antar
                            kota di Kalimantan Timur?</span>
                        <div :class="{'bg-brand-500 text-white rotate-180': selected === 0, 'bg-gray-100 dark:bg-gray-700 text-gray-500': selected !== 0}"
                            class="w-8 h-8 rounded-full flex items-center justify-center transition-all duration-300 transform">
                            <svg class="w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </div>
                    </button>
                    <div x-show="selected === 0" x-collapse
                        class="px-6 pb-6 text-gray-500 dark:text-gray-400 leading-relaxed border-t border-gray-50 dark:border-gray-700/50 pt-4">
                        Transportasi antar kota (misalnya Balikpapan-Samarinda-Tenggarong) umumnya menggunakan mobil travel,
                        bus, atau mobil sewaan. Akses jalan tol Balikpapan-Samarinda sudah tersedia untuk mempersingkat
                        waktu tempuh.
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div data-aos="fade-up" data-aos-delay="200"
                    class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-md">
                    <button @click="selected !== 1 ? selected = 1 : selected = null"
                        class="w-full px-6 py-5 text-left flex justify-between items-center focus:outline-none">
                        <span class="font-bold text-gray-900 dark:text-gray-100 text-lg">Apakah sinyal internet tersedia di
                            semua lokasi wisata?</span>
                        <div :class="{'bg-brand-500 text-white rotate-180': selected === 1, 'bg-gray-100 dark:bg-gray-700 text-gray-500': selected !== 1}"
                            class="w-8 h-8 rounded-full flex items-center justify-center transition-all duration-300 transform">
                            <svg class="w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </div>
                    </button>
                    <div x-show="selected === 1" x-collapse
                        class="px-6 pb-6 text-gray-500 dark:text-gray-400 leading-relaxed border-t border-gray-50 dark:border-gray-700/50 pt-4">
                        Di kota besar seperti Balikpapan, Samarinda, dan Bontang, jaringan 4G stabil. Di area Kepulauan
                        Derawan, sinyal tersedia namun kadang tidak stabil tergantung cuaca dan lokasi pulau.
                        Untuk wisata pedalaman atau hulu Sungai Mahakam, sinyal seringkali terbatas atau tidak ada sama
                        sekali.
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div data-aos="fade-up" data-aos-delay="300"
                    class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-md">
                    <button @click="selected !== 2 ? selected = 2 : selected = null"
                        class="w-full px-6 py-5 text-left flex justify-between items-center focus:outline-none">
                        <span class="font-bold text-gray-900 dark:text-gray-100 text-lg">Apakah ada persiapan khusus untuk
                            wisata ke pedalaman atau hutan?</span>
                        <div :class="{'bg-brand-500 text-white rotate-180': selected === 2, 'bg-gray-100 dark:bg-gray-700 text-gray-500': selected !== 2}"
                            class="w-8 h-8 rounded-full flex items-center justify-center transition-all duration-300 transform">
                            <svg class="w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </div>
                    </button>
                    <div x-show="selected === 2" x-collapse
                        class="px-6 pb-6 text-gray-500 dark:text-gray-400 leading-relaxed border-t border-gray-50 dark:border-gray-700/50 pt-4">
                        Disarankan membawa pakaian yang nyaman dan menyerap keringat, sepatu yang kuat untuk berjalan, serta
                        lotion anti nyamuk atau serangga.
                        Jika Anda memiliki riwayat penyakit tertentu, pastikan membawa obat-obatan pribadi karena akses
                        apotek di wilayah pedalaman cukup jauh.
                    </div>
                </div>
            </div>
        </section>





        <!-- Preloader -->
        <div x-data="{ 
                                visible: !sessionStorage.getItem('landing_loaded'),
                                init() {
                                    if(this.visible) {
                                         document.body.classList.add('overflow-hidden');
                                         setTimeout(() => {
                                            this.visible = false;
                                            sessionStorage.setItem('landing_loaded', 'true');
                                            document.body.classList.remove('overflow-hidden');
                                         }, 3000); // 3 seconds duration
                                    }
                                }
                            }" x-show="visible" x-transition:leave="transition ease-in duration-500"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-[100] bg-white dark:bg-gray-900 flex flex-col items-center justify-center">

            <div class="mb-4 animate-bounce">
                <div
                    class="w-24 h-24 rounded-2xl overflow-hidden shadow-xl shadow-brand-500/30 flex items-center justify-center bg-white">
                    <img src="{{ asset('WisataKaltim.jpeg') }}" alt="Loading Logo" class="w-full h-full object-cover">
                </div>
            </div>

            <h2 class="text-2xl font-bold text-gray-800 dark:text-white tracking-wide animate-pulse">
                Wisata<span class="text-brand-500">Kaltim</span>
            </h2>

            <div class="mt-8 flex gap-2">
                <div class="w-3 h-3 bg-brand-500 rounded-full animate-bounce [animation-delay:-0.3s]"></div>
                <div class="w-3 h-3 bg-brand-500 rounded-full animate-bounce [animation-delay:-0.15s]"></div>
                <div class="w-3 h-3 bg-brand-500 rounded-full animate-bounce"></div>
            </div>

        </div>

    </div>
@endsection