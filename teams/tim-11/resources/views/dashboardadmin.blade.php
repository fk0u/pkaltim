@extends('layouts.admin')

@section('title', 'Dashboard Overview')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Dashboard Overview</h1>
        <p class="text-gray-500 mt-1">Statistik dan ringkasan sistem Sireta</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
        <!-- Total Kuliner Card -->
        <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-100 relative overflow-hidden group hover:shadow-2xl transition-all duration-300">
            <div class="absolute -right-6 -top-6 bg-orange-50 w-32 h-32 rounded-full opacity-50 group-hover:scale-110 transition-transform duration-500"></div>
            <div class="flex items-center justify-between relative z-10">
                <div>
                    <p class="text-gray-500 text-xs font-bold uppercase tracking-wider">Total Kuliner</p>
                    <h3 class="text-4xl font-extrabold text-gray-900 mt-2">{{ $totalKuliner ?? 0 }}</h3>
                    <p class="text-green-500 text-xs font-medium mt-2 flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        Data Terupdate
                    </p>
                </div>
                <div class="bg-gradient-to-br from-orange-400 to-red-500 p-4 rounded-2xl shadow-lg text-white transform group-hover:rotate-6 transition-transform duration-300">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Ulasan Card -->
        <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-100 relative overflow-hidden group hover:shadow-2xl transition-all duration-300">
            <div class="absolute -right-6 -top-6 bg-green-50 w-32 h-32 rounded-full opacity-50 group-hover:scale-110 transition-transform duration-500"></div>
            <div class="flex items-center justify-between relative z-10">
                <div>
                    <p class="text-gray-500 text-xs font-bold uppercase tracking-wider">Total Ulasan</p>
                    <h3 class="text-4xl font-extrabold text-gray-900 mt-2">{{ $totalReviews ?? 0 }}</h3>
                    <p class="text-green-500 text-xs font-medium mt-2 flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        Aktif
                    </p>
                </div>
                <div class="bg-gradient-to-br from-green-400 to-emerald-500 p-4 rounded-2xl shadow-lg text-white transform group-hover:rotate-6 transition-transform duration-300">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Rating Card -->
        <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-100 relative overflow-hidden group hover:shadow-2xl transition-all duration-300">
            <div class="absolute -right-6 -top-6 bg-yellow-50 w-32 h-32 rounded-full opacity-50 group-hover:scale-110 transition-transform duration-500"></div>
            <div class="flex items-center justify-between relative z-10">
                <div>
                    <p class="text-gray-500 text-xs font-bold uppercase tracking-wider">Rating Rata-rata</p>
                    <h3 class="text-4xl font-extrabold text-gray-900 mt-2">{{ number_format($avgRating ?? 0, 1) }}</h3>
                    <div class="flex items-center mt-2">
                        @for($i=1; $i<=5; $i++)
                            <svg class="w-3 h-3 {{ $i <= round($avgRating) ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        @endfor
                    </div>
                </div>
                <div class="bg-gradient-to-br from-yellow-400 to-amber-500 p-4 rounded-2xl shadow-lg text-white transform group-hover:rotate-6 transition-transform duration-300">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Kuliner -->
        <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-100 border-t-4 border-t-orange-500">
            <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                <span class="p-2 bg-orange-100 rounded-lg mr-3 shadow-sm">
                    <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </span>
                Kuliner Terbaru
            </h3>
            <div class="space-y-4">
                @if($recentKuliner && $recentKuliner->count() > 0)
                    @foreach($recentKuliner as $kuliner)
                        <div class="flex items-center space-x-4 p-4 hover:bg-orange-50/50 rounded-xl transition duration-200 border border-transparent hover:border-orange-100 cursor-default group">
                            <div class="w-16 h-16 bg-gray-200 rounded-xl overflow-hidden flex-shrink-0 shadow-sm group-hover:shadow-md transition-shadow">
                                @if ($kuliner && $kuliner->gambar)
                                    <img src="{{ asset('storage/' . ($kuliner->gambar ?? '')) }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="">
                                @elseif($kuliner && $kuliner->external_image_url)
                                    <img src="{{ $kuliner->external_image_url ?? '' }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt=""
                                         onerror="this.style.display='none'">
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-bold text-gray-900 truncate group-hover:text-orange-600 transition-colors">{{ $kuliner->nama_kuliner ?? 'N/A' }}</p>
                                <p class="text-sm text-gray-500 flex items-center mt-1">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    {{ $kuliner->asal_daerah ?? 'N/A' }}
                                </p>
                            </div>
                            <button onclick="openDetailModal({{ $kuliner->id }})" class="p-2 text-gray-400 hover:text-orange-500 hover:bg-white rounded-full transition-all shadow-sm opacity-0 group-hover:opacity-100 focus:outline-none">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </button>
                        </div>
                    @endforeach
                @else
                    <div class="text-center py-8 bg-gray-50 rounded-xl border border-dashed border-gray-200">
                        <p class="text-gray-500">Belum ada kuliner</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Recent Reviews -->
        <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-100 border-t-4 border-t-orange-500">
            <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                <span class="p-2 bg-green-100 rounded-lg mr-3 shadow-sm">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                </span>
                Ulasan Terbaru
            </h3>
            <div class="space-y-4">
                @if(isset($recentReviews) && $recentReviews->count() > 0)
                    @foreach($recentReviews as $review)
                        <div class="flex items-start space-x-4 p-4 hover:bg-orange-50/50 rounded-xl transition duration-200 border border-transparent hover:border-orange-100 cursor-default">
                            <div class="w-10 h-10 bg-gradient-to-br from-orange-400 to-red-400 rounded-full flex items-center justify-center text-white font-bold text-xs flex-shrink-0 shadow-md">
                                AN
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between items-start">
                                    <p class="font-bold text-gray-900 truncate">Anonymous</p>
                                    <span class="text-xs text-gray-400 bg-gray-100 px-2 py-0.5 rounded-full">{{ $review->created_at ? $review->created_at->diffForHumans() : 'N/A' }}</span>
                                </div>
                                <p class="text-sm text-gray-600 line-clamp-2 mt-1 italic">"{{ $review->ulasan ?? 'N/A' }}"</p>
                                <p class="text-xs font-semibold text-orange-500 mt-2 flex items-center">
                                    <span class="w-1.5 h-1.5 bg-orange-500 rounded-full mr-1.5"></span>
                                    {{ $review->kuliner->nama_kuliner ?? 'N/A' }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center py-8 bg-gray-50 rounded-xl border border-dashed border-gray-200">
                        <p class="text-gray-500">Belum ada ulasan</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Detail Modal -->
    <div id="detailModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeDetailModal()"></div>

            <!-- Modal panel -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
                <!-- Header Image -->
                <div class="relative h-48 bg-gray-200">
                    <img id="modalImg" src="" alt="Kuliner Image" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <button onclick="closeDetailModal()" class="absolute top-4 right-4 bg-white/20 hover:bg-white/40 text-white rounded-full p-2 backdrop-blur-sm transition">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <div class="absolute bottom-4 left-6">
                        <span id="modalCategory" class="px-2 py-1 bg-orange-500 text-white text-xs font-bold rounded-full uppercase tracking-wider">Kategori</span>
                    </div>
                </div>

                <div class="px-6 py-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900" id="modalTitle">Loading...</h3>
                            <p class="text-sm text-gray-500 flex items-center mt-1">
                                <svg class="w-4 h-4 mr-1 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span id="modalRegion">...</span>
                            </p>
                        </div>
                        <div class="flex flex-col gap-2 scale-90 origin-top-right">
                             <span id="modalHalal" class="hidden px-2 py-1 bg-green-100 text-green-800 text-xs font-bold rounded-full text-center">HALAL</span>
                             <span id="modalNonHalal" class="hidden px-2 py-1 bg-red-100 text-red-800 text-xs font-bold rounded-full text-center">NON-HALAL</span>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h4 class="text-sm font-bold text-gray-900 uppercase tracking-wide mb-2">Deskripsi</h4>
                        <p class="text-gray-600 text-sm leading-relaxed" id="modalDesc">Loading description...</p>
                    </div>

                    <div class="mt-6 pt-4 border-t border-gray-100 flex justify-end">
                        <button type="button" class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-4 py-2 bg-orange-600 text-base font-medium text-white hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 sm:ml-3 sm:w-auto sm:text-sm transition-colors" onclick="closeDetailModal()">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Scripts -->
    <script>
        function openDetailModal(id) {
            const modal = document.getElementById('detailModal');
            modal.classList.remove('hidden');

            // Reset Content
            document.getElementById('modalTitle').innerText = 'Loading...';
            document.getElementById('modalDesc').innerText = 'Taking a bite...';
            document.getElementById('modalImg').src = 'https://via.placeholder.com/640x360?text=Loading';

            // Fetch Data
            fetch(`/dashboard/admin/kuliner/${id}/show`)
                .then(response => response.json())
                .then(data => {
                    if(data) {
                        // Title & Region
                        document.getElementById('modalTitle').innerText = data.nama_kuliner || 'No Name';
                        document.getElementById('modalRegion').innerText = data.asal_daerah || 'Unknown Location';
                        document.getElementById('modalDesc').innerText = data.deskripsi || 'No description available.';

                        // Image
                        let imgSrc = 'https://via.placeholder.com/640x360?text=No+Image';
                        if (data.external_image_url) {
                            imgSrc = data.external_image_url;
                        } else if (data.gambar) {
                            imgSrc = "{{ asset('storage/') }}/" + data.gambar;
                        }
                        document.getElementById('modalImg').src = imgSrc;

                        // Categories
                        if (data.categories && data.categories.length > 0) {
                             document.getElementById('modalCategory').innerText = data.categories[0].nama_kategori;
                             document.getElementById('modalCategory').classList.remove('hidden');
                        } else {
                             document.getElementById('modalCategory').classList.add('hidden');
                        }

                        // Badges
                        if (data.is_halal) {
                            document.getElementById('modalHalal').classList.remove('hidden');
                            document.getElementById('modalNonHalal').classList.add('hidden');
                        } else {
                            document.getElementById('modalHalal').classList.add('hidden');
                            document.getElementById('modalNonHalal').classList.remove('hidden');
                        }
                    }
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                    document.getElementById('modalDesc').innerText = 'Error loading data.';
                });
        }

        function closeDetailModal() {
            document.getElementById('detailModal').classList.add('hidden');
        }
    </script>
@endsection
